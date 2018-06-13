<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsImportRequest extends FormRequest {
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
            'sheet' => 'required|mimeTypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/csv,'
                . 'application/excel,application/vnd.ms-excel,application/vnd.msexcel,text/csv,text/anytext,text/plain,text/x-c'
        ];
    }
}
