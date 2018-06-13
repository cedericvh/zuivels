<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest as Request;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends AccessTokenController {
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
        $user = User::create($data);
        $user->roles()->attach(Role::where('name', 'customer')->first());
        return response()->json(['success' => $user ? true : false]);
    }

    /**
     * Hooks in before the AccessTokenController issues a token
     *
     *
     * @param  ServerRequestInterface $request
     * @return mixed
     */
    public function issueUserToken(ServerRequestInterface $request) {
        if (request()->get('grant_type') == 'password') {
            $user = User::whereEmail(request()->get('username'))->first();
            if ($user && !$user->approved) {
                abort(401, 'The user not approved');
            }
            return $this->issueToken($request);
        }
    }
}
