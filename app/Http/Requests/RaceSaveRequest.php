<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RaceSaveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'date' => 'required|date_format:d-m-Y H:i',
            'rules' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 422));
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'date.required' => 'Date is required',
            'rules.required' => 'Rules is required'
        ];
    }
}
