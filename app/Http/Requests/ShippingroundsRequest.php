<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingroundsRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name'     => 'required',
            'description'    => 'required',
            'extra_remark' => 'sometimes',
            'file1' => 'sometimes',
            'file2' => 'sometimes',
            'file3' => 'sometimes',
        ];
    }
}
