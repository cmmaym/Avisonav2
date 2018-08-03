<?php

namespace AvisoNavAPI\Http\Requests\CatalogOceanCoast;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatalogOceanCoast extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'edition'       => 'required|numeric',
            'year'          => 'required|numeric',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required'              =>  'El campo :attribute es requerido',
            'numeric'               =>  'El campo :attribute debe ser un numero',
        ];
    }
}
