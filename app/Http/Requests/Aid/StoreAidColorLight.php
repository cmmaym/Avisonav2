<?php

namespace AvisoNavAPI\Http\Requests\Aid;

use Illuminate\Foundation\Http\FormRequest;

class StoreAidColorLight extends FormRequest
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
            'angle'                          => 'nullable|numeric',
            'colorLight'                      => 'required|exists:color_light,id',
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
            'exists'                =>  'El valor seleccionado para el campo :attribute es invalido',
        ];
    }
}
