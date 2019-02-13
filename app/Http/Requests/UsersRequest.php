<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        
      
        if(request()->has('id')){
        return [
            'name'     => 'required',
            
            //'email' => 'unique:users,email,'.$this->id,
            'password' => request()->method() == 'PUT' ? '' : 'min:6|required|confirmed'
        ];
        }else{
           return [
            'name'     => 'required',
            'email'    => 'required|email|unique:users' . (request()->has('id') ? ",email,{$this->request->get('id')},id" : ''),
            //'email' => 'unique:users,email,'.$this->id,
            'password' => request()->method() == 'PUT' ? '' : 'min:6|required|confirmed' 
             ];
        }
    }
}
