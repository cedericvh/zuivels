<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function submit(Request $request) {
      $data = $request->except('test');
      
      
        $this->validate($request, [
            'name' => 'required|string',
            'adres' => 'required|string',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        
      
      
        $admin = User::whereHas('roles', function ($query) {
            $query->whereName('Admin');
        })->first();
        
        Mail::to($admin)->send(new \App\Mail\FormSubmitted(false,$data));      
      
        return response()->json(null, 200);
    }
}
