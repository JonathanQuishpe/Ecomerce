<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductFormRequest extends FormRequest {

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
            'name' => 'required|max:255',
            'sku' => 'required',
            'brand_id' => 'required|not_in:0',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'sale_price' => 'regex:/^\d+(\.\d{1,2})?$/',
            'quantity' => 'required|numeric',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'El campo nombre es requerido.',
            'name.max' => 'La longitud del nombre debe ser ser menor a 255 caracteres.',
            'sku.required' => 'El código es requerido.',
            'brand_id.required' => 'La marca es requerida.',
            'price.required' => 'El precio es requerido.',
            'price.regex' => 'El precio no cumple con el formato.',
            'sale_price.regex' => 'El precio especial no cumple con el formato.',
            'quantity.required' => 'La cantidad es requerida.',
            'quantity.numeric' => 'La cantidad no cumple con el formato.',
        ];
    }

}
