<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest as Request;
use App\Models\User;

class AuthController extends Controller {
    /**
     * AuthController constructor.
     */
    public function __construct() {
        $this->model = new User;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUser() {
        return response()->json(['user' => auth()->user()]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        return response()->json(['success' => auth()->user()->logout()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = $this->model->create($data);
        $user->roles()->attach(Role::where('name', 'customer')->first());
        return response()->json(['success' => $user ? true : false]);
    }
}
