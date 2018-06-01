<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    /**
     * Admin's login page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin() {
        return view('client.auth.login');
    }

    /**
     * Post login form
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogin(LoginRequest $request) {
        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials, $request->get('remember'))) {

            return redirect(route('client.aanbod.index'));
        }

        return redirect(route('client.auth.getLogin'))
            ->withErrors('Invalid credentials.');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getLogout() {
        Auth::logout();

        return redirect(route('client.index.index'));
    }
}
