<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller {

    public function __construct() {
        $this->model = new Category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index() {
        $categories = $this->model->orderBy('sorting_id')->get()->toHierarchy();
        return response()->json(compact('categories'));

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function indexLeaves() {
        $categories = $this->model->find(1)->getLeaves();
        return response()->json(compact('categories'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTree(Request $request) {
        $tree = $request->all();
        $result = $this->model->buildTree($tree);
        return response()->json(['success' => $result]);
    }
}
