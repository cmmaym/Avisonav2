<?php

namespace AvisoNavAPI\Http\Requests\TipoColor;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoColor extends FormRequest
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
            'tipoColor.*.color'     => 'required|max:100',
            'tipoColor.*.alias'     =>  'required|max:45',
            'tipoColor.*.estado'    => 'required|required|in:A,I',
            'tipoColor.*.idioma_id' => 'required|exists:idioma,id',
            'tipoColor'             => 'idioma_duplicate',
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
            'in'                    =>  'El valor seleccionado para el campo :attribute es invalido',
            'exists'                =>  'El valor seleccionado para el campo :attribute es invalido',
            'idioma_duplicate'      =>  'Registros con idioma duplicado',
        ];
    }
}
