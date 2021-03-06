<?php
namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Http\Requests\OrdersRequest;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use function compact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        $data = $request->except('test');
        //var_dump($data);
        $data['email'] = $request->user()->email;
        $data['dategetorder'] = Carbon::today();
        $data['rejected'] = false;
        $data['date'] = Carbon::createFromTimestamp($data['date']/1000);
        $data['products'] = $request->get('products');
      
        //var_dump($data['products']);
      
        $order = $this->model->create($data);
        $products = $request->get('products'); 
      
        //var_dump(gettype($products));
        
        foreach ($products as &$value) {         
          unset($value["title"]);
        }
        $order->products()->attach($products);
      
        event(new OrderCreated($order));
      
        Mail::to($request->user())->locale('nl')->send(new \App\Mail\OrderCreated(true,$data));
        $admin = User::whereHas('roles', function ($query) {
            $query->whereName('Admin');
        })->first();
        
        Mail::to($admin)->locale('nl')->send(new \App\Mail\OrderCreated(false,$data));
        
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
    public function latest() {
        $order = $this->model->whereEmail(auth()->user()->email)->orderBy('created_at', 'DESC')->with(['products' => function($query) {
            $query->select(['products.id'   ]);
        }])->first(['id']);
        return response()->json(compact('order'));
    }
}