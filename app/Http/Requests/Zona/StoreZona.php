<?php

namespace AvisoNavAPI\Http\Requests\Zona;

use Illuminate\Foundation\Http\FormRequest;

class StoreZona extends FormRequest
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
            'zona.*.nombre'    => 'required|max:100',
            'zona.*.alias'    =>  'required|max:45',
            'zona.*.estado'    => 'required|required|in:A,I',
            'zona.*.idioma_id' => 'required|exists:idioma,id',
            'zona'             => 'idioma_duplicate',
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
