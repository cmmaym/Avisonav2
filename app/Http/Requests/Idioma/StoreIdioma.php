<?php

namespace AvisoNavAPI\Http\Requests\Idioma;

use Illuminate\Foundation\Http\FormRequest;

class StoreIdioma extends FormRequest
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
            'nombre'    => 'required|max:45',
            'alias'     => 'required|max:45',
            'estado'    => 'required|in:A,I',
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
            'required'  =>  'El campo :attribute es requerido',
            'max'       =>  'El campo :attribute debe tener maximo :max caracteres',
            'in'        =>  'El valor seleccionado para el campo :attribute es invalido',
        ];
    }
}
