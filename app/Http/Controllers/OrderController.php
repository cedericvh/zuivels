<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller {
    //

    public function success() {

        return view('client.orders.success');
    }

    public function winkelmandje() {

        return view('client.winkelmandje.index');
    }

    public function store(Request $request) {

        $this->validate($request, [

            'email' => 'required|email',

        ]);

        $orderData = $request->only([

            'email',

        ]);

        $orderData['bestelling'] = $request->get('bestelling');

        $order = Order::create($orderData);

        event(new OrderCreated($order));

        return redirect(route('client.orders.success'))
            ->with('success', true)
            ->with('orderdata', $orderData['bestelling']);
    }
}
