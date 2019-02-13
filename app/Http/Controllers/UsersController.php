<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Http\Requests\UsersRequest as Request;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller {
    public $model;

    /**
     * UsersController constructor.
     */
    public function __construct() {
        $this->model = new User;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $users = $this->model->get();
        return response()->json(['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      
      
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'email',
            'password' => 'required|confirmed|min:6',
        ]);
      
        $data = $request->except('roles');
        $address = $data['address'];
        $data['password'] = bcrypt($data['password']);
        $user = $this->model->create($data);
        $resultaddress = $user->address()->create($address);
      
        $roles = $request->get('roles');
        $user->roles()->attach(collect($roles)->pluck('id')->toArray());          
        
        
        $shippinground = $request->get('shippingrounds');        
        $shippingroundId = $shippinground["id"];
        $result3 = $user->address()->update(['shippinground_id' => $shippingroundId]);   
        
        return response()->json(['success' => $user ? true : false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = $this->model->whereId($id)->with('roles')->with('address')->first();
        

        $address = Address::where('user_id', '=', $id)->with('shippinground')->firstOrFail();
        
        $array = array_merge($user->toArray(), $address->toArray());
        

        
        return response()->json(['user' => $array]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = $this->model->whereId($id)->with('roles')->first();
        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
      
      
      $this->validate($request, [
          'name' => 'required|min:3|max:50',
          'email' => 'email',
          'password' => 'confirmed',
      ]);
      
        $data = $request->all();
        $address = $data['address'];
        //var_dump($data);
        if ($request->has('password')) $data['password'] = bcrypt($data['password']);
        $user = $this->model->whereId($id)->first();
        $result1 = $user->update($data);
        $result2 = $user->address()->update($address);
        $roles = $request->get('roles');
        $user->roles()->sync(collect($roles)->pluck('id')->toArray());
      
        $shippinground = $request->get('shippinground');        
        $shippingroundId = $shippinground["id"];
        $result3 = $user->address()->update(['shippinground_id' => $shippingroundId]);      
      
      
        return response()->json(['success' => [$result1,$result2,$result3]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $result = $this->model->destroy($id);
        return response()->json(['success' => $result]);
    }

    public function approve($id) {
        $result = $this->model->whereId($id)->update(['approved' => true]);     
      
      
        $user = $this->model->whereId($id)->first();
      
        Mail::to($user)->send(new \App\Mail\UserApproved(true));
       
      
        return response()->json(['success' =>$result]);
    }
}
