<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UsersRequest as Request;

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
        $data = $request->except('roles');
        $data['password'] = bcrypt($data['password']);
        $user = $this->model->create($data);
        $roles = $request->get('roles');
        $user->roles()->attach(collect($roles)->pluck('id')->toArray());
        return response()->json(['success' => $user ? true : false]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user = $this->model->whereId($id)->with('roles')->first();
        return response()->json(['user' => $user]);
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
        $data = $request->all();
        if ($request->has('password')) $data['password'] = bcrypt($data['password']);
        $user = $this->model->whereId($id)->first();
        $result = $user->update($data);
        $roles = $request->get('roles');
        $user->roles()->sync(collect($roles)->pluck('id')->toArray());
        return response()->json(['success' => $result]);
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
        return response()->json(['success' =>$result]);
    }
}
