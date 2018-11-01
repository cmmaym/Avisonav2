<?php

namespace AvisoNavAPI\Http\Requests\Chart;

use Illuminate\Foundation\Http\FormRequest;

class StoreChartEdition extends FormRequest
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
            'max'                   =>  'El campo :attribute debe tener maximo :max caracteres',
        ];
    }
}
