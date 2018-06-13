<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Http\Requests\OrdersRequest;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrdersController extends Controller {
    /**
     * OrdersController constructor.
     */
    public function __construct() {
        $this->model = new Order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $orders = $this->model->with('products')->orderBy('id', 'DESC')->get();
        return response()->json(compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrdersRequest $request) {
        $data = $request->except('products');
        $data['email'] = $request->user()->email;
        $data['dategetorder'] = Carbon::today();
        $data['rejected'] = false;
        $data['date'] = Carbon::createFromFormat('d/m/Y H:i', $data['date']);
        $order = $this->model->create($data);
        $products = $request->get('products');
        $order->products()->attach($products);
        event(new OrderCreated(!!$order));
        return response()->json(['success' => !!$order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
