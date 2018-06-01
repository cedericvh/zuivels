<?php

namespace App\Http\Controllers\Api;

use function functionCallback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

class CallapiController extends Controller {

    /**
     * Attaches Product to category.
     *
     * @param  int $product
     * @param  int $category
     * @return \Illuminate\Http\Response
     */
    public function apiAttachToCategory($product_id, $category_id) {
        $category = Category::find($category_id);
        $product = Product::find($product_id);
        $product->categories()->attach($category);
    }

    /**
     * @param $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiFetchAttachedCategories($product_id) {
        $product = Product::find($product_id);
        $categories = $product->categories('title')->pluck('id');

        return response()->json([
            'status'     => 200,
            'categories' => $categories
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiFetchCategories() {
        $categories = Category::whereTitle('Productgroepen')->first()->getDescendantsAndSelf()->toHierarchy();
        return response()->json(['status' => 200, 'categories' => $categories]);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiFetchProducts(Request $request) {
        $categoryIds = $request->all();
        $products = Product::all();
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
        }
        return response()->json(['status' => 200, 'products' => array_values($products->toArray())]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiFetchUserData(Request $request) {
        $userdata = $request->session()->all();
        return response()->json(['status' => 200, 'userdata' => $userdata]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiCheckout(Request $request) {
        $orderData['bestelling'] = serialize($request->get('products'));
        $orderData['email'] = $request->get('userdata')['email'];
        $orderData['dategetorder'] = $request->get('userdata')['email'];
        $orderData['date'] = Carbon::now('Europe/Brussels');
        $orderData['dategetorder'] = Carbon::now('Europe/Brussels');

        $order = Order::create($orderData);
        return response()->json(['status' => 200]);

    }
}
