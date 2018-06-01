<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\ProductsRequest as Request;

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
        $products = $this->model->get();
//        $products = $this->model->latest()->paginate(5);
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
    public function store(Request $request) {
        $model = $this->model->create($request->all());
        return response()->json(['success' => $model ? true : false]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
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
    public function update(Request $request, $id) {
        $success = $this->model->whereId($id)->update($request->all());
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
        return response()->json(compact('success'));
    }

    /**
     * Attaches Product to category.
     *
     * @param  int $product
     * @param  int $category
     * @return \Illuminate\Http\Response
     */
    public function apiAttachToCategory($product, $category) {
        //
        //$job->delete();
        $cat = Category::find($category);
        //$category = Category::roots()->first();
        $pr = Product::find($product);
        $pr->categories()->attach($cat);

        //return redirect(route('admin.products.index'))
        //        ->with('success', $pr,$cat);
    }

    public function apiFetchAttachedCategories($product) {
        $pr = Product::find($product);
        $categories = $pr->categories('title')->pluck('title');

        return response()->json([
            'status'     => 200,
            'categories' => $categories
        ]);
    }
}
