<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest {

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
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'post_code' => 'required',
            'phone_number' => 'required',
        ];
    }

    public function messages() {
        return [
            'first_name.required' => 'El campo nombre es requerido.',
            'last_name.required' => 'El campo apellido es requerido.',
            'address.required' => 'El campo dirección es requerido.',
            'city.required' => 'El campo ciudad es requerido.',
            'country.required' => 'El campo pais es requerido.',
            'post_code.required' => 'El campo código postal es requerido.',
            'phone_number.required' => 'El campo teléfono es requerido.',
            'phone_number.required' => 'El campo teléfono es requerido.',
        ];
    }

}
