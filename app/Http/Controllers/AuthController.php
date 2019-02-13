<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistered;
use App\Models\Role;
use App\Models\User;
use App\Models\Address;
use App\Models\Shippinground;
use App\Http\Requests\RegisterRequest as Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;

class AuthController extends AccessTokenController {
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function showUser() {
        
              
        $user = auth()->user()->load('address');
      
        
        if(isset(auth()->user()->address->shippinground_id)){
          $shippingRoundId = auth()->user()->address->shippinground_id;
          $shippinground = Shippinground::where('id', $shippingRoundId)->first();
        
        //$shippinground = Shippinground::whereId(request()->get('id'))->first();
        //var_dump($shippinground);
        
          $user->shippinground = $shippinground;
        }
        
      
        return response()->json(['user' => $user]);
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
        $data = $request->except('address');
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $user->roles()->attach(Role::where('name', 'customer')->first());
        $user->address()->create($request->get('address'));
        $admin = User::whereHas('roles', function ($query) {
            $query->whereName('Admin');
        })->first();
        Mail::to($admin)->send(new UserRegistered);
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
