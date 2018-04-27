<?php

namespace AvisoNavAPI\Http\Requests\LightType;

use Illuminate\Foundation\Http\FormRequest;

class StoreLightTypeLang extends FormRequest
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
            'class'           => 'required|max:100',
            'alias'           => 'required|max:45',
            'description'     => 'required',
            'language_id'     => 'required|exists:language,id'
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
            'max'                   =>  'El campo :attribute debe tener maximo :max caracteres',
            'exists'                =>  'El valor seleccionado para el campo :attribute es invalido'
        ];
    }
}