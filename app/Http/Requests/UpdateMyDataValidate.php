<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMyDataValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'sufix' => 'required',
            'owner' => 'required',
            'vat' => 'required',
            'street' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'iban' => 'required',
            'bank' => 'required'
        ];
    }
}
