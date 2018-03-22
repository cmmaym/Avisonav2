<?php

namespace AvisoNavAPI\Http\Requests\Ubicacion;

use Illuminate\Foundation\Http\FormRequest;

class StoreUbicacion extends FormRequest
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
            'ubicacion'         => 'required|max:100',
            'sub_ubicacion'     => 'nullable|max:100',
            'estado'            => 'required|in:A,I',
            'zona_id'           => 'required|exists:zona,id'
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
            'exists'    =>  'El valor seleccionado para el campo :attribute es invalido',
        ];
    }
}
