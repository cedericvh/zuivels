<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsImportRequest;
use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductsRequest;
use Illuminate\Http\Request;
use Excel;

class ProductsController extends Controller {

    public function __construct() {
        $this->model = new Product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $products = $this->model->orderBy('sorting_id', 'ASC')->with('categories')->get();
        $categoryIds = request()->get('categories');
        if (!empty($categoryIds)) {
            $categories = Category::whereIn('id', $categoryIds)->get();
            $products = $products->filter(function ($item) use ($categories) {
                foreach ($item->categories as $productCategory) {
                    foreach ($categories as $selectedCategory) {
                        if ($productCategory->isSelfOrDescendantOf($selectedCategory)) {
                            return true;
                        }
                    }
                }
            });
            $products = array_values($products->toArray());
        }

        return response()->json(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductsRequest $request) {
        $data = $request->all();
        $data['sorting_id'] = $this->model->orderBy('sorting_id', 'DESC')->pluck('sorting_id')->first() + 1;
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('public');
        }
        $model = $this->model->create($data);
        return response()->json(['success' => $model ? true : false]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id) {
        $product = $this->model->whereId($id)->first();
        return response()->json(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Product $product) {
        return response()->json(compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductsRequest $request, $id) {
        $data = $request->except('_method');
        if ($request->file('image')) {
            $data['image'] = $request->file('image')->store('public');
        }
        $success = $this->model->whereId($id)->update($data);
        return response()->json(compact('success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product) {
        $success = $product->delete();
        $this->model->where('sorting_id', '>', $product->sorting_id)->decrement('sorting_id');
        return response()->json(compact('success'));
    }

    /**
     * @param $oldId
     * @param $newId
     * @return \Illuminate\Http\JsonResponse
     */
    public function sort($oldId, $newId) {
        $product = $this->model->whereSortingId($oldId)->first();
        $result = $product->update(['sorting_id' => $newId]);
        $query = $this->model->whereBetween('sorting_id', ($oldId < $newId ? [$oldId, $newId] : [$newId, $oldId]))
            ->where('id', '!=', $product->id);
        if ($oldId > $newId) $query->increment('sorting_id');
        else $query->decrement('sorting_id');

        return response()->json(['success' => $result]);
    }

    /**
     * Attaches Product to category.
     *
     * @param  int $product
     * @param  int $category
     * @return \Illuminate\Http\Response
     */
    public function apiAttachToCategory($product, $category) {
        $cat = Category::find($category);
        $pr = Product::find($product);
        $pr->categories()->attach($cat);
    }

    /**
     * @param $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiFetchAttachedCategories($product) {
        $pr = Product::find($product);
        $categories = $pr->categories('title')->pluck('title');

        return response()->json([
            'status'     => 200,
            'categories' => $categories
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(ProductsImportRequest $request) {
        $file = $request->file('sheet');
        $products = [];
        $cat = '';
        $sub = '';
        Excel::load($file)->noHeading()->each(function ($row) use (&$products, &$cat, &$sub) {
            if ($row[5]) {
                $product = ['title' => $row[5], 'image' => $row[6]];
                if ($row[1]) {
                    $cat = $row[1];
                    $products[$cat] = [];
                    if (!$row[3]) {
                        $sub = 'no_sub';
                    }
                };
                if ($row[3] && $sub != 'no_sub') {
                    $sub = $row[3];
                    $products[$cat][$sub] = [];
                };
                if ($sub && $sub != 'no_sub') {
                    $products[$cat][$sub][] = $product;
                } else {
                    $products[$cat][] = $product;
                }
            }
        });
        return response()->json(compact('products'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request) {
        $products = $request->all();
        $sortingId = $this->model->orderBy('sorting_id', 'DESC')->pluck('sorting_id')->first() ?: 1;
        foreach ($products as $catName => $cat) {
            $newCat = $this->saveCategory($catName);
            foreach ($cat as $subName => $item) {
                if (is_int($subName)) {
                    $product = $this->saveProduct($item, $sortingId);
                    $product->categories()->attach($newCat);
                } else {
                    $newCat = $this->saveCategory($subName, $catName);
                    foreach ($item as $subItem) {
                        $product = $this->saveProduct($subItem, $sortingId);
                        $product->categories()->attach($newCat);
                    }
                }
                $success = $product ? true : false;
            }
        }
        return response()->json(compact('success'));
    }

    /**
     * @param      $name
     * @param null $parent
     * @return mixed
     */
    public function saveCategory($name, $parent = null) {
        $exists = Category::whereTitle($name)->first();
        if ($exists) return $exists;
        $base = $parent !== null ? Category::whereTitle($parent)->first() : Category::whereTitle('Productgroepen')->first();
        return $base->children()->create(['title' => $name]);
    }

    /**
     * @param $item
     * @param $sortingId
     * @return mixed
     */
    public function saveProduct($item, &$sortingId) {
        $item['description'] = '';
        $item['image'] = $item['image'] ?: '';
        $item['sorting_id'] = ++$sortingId;
        return $this->model->create($item);
    }
}
