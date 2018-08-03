<?php

namespace AvisoNavAPI\Http\Requests\LightClass;

use Illuminate\Foundation\Http\FormRequest;

class StoreLightClass extends FormRequest
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
            'alias'           => 'required|max:45',
            'description'     => 'sometimes|required',
            'class'           => 'sometimes|required|max:100',
            'illustration'    => 'nullable',
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
            'in'                    =>  'El valor seleccionado para el campo :attribute es invalido',
            'max'                   =>  'El campo :attribute debe tener maximo :max caracteres',
        ];
    }
}
