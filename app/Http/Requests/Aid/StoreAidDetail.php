<?php

namespace AvisoNavAPI\Http\Requests\Aid;

use Illuminate\Foundation\Http\FormRequest;

class StoreAidDetail extends FormRequest
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
            'description'                 => 'required',
            'observation'                 => 'required',
            'state'                       => 'sometimes|required|in:A,I',
            'coordinate_id'               => 'required|exists:coordinate,id',
            'light_type_id'               => 'required|exists:light_type,id',
            'color_type_id'               => 'required|exists:color_type,id',
            'novelty_type_id'             => 'required|exists:novelty_type,id',
            'language_id'                 => 'required|exists:language,id',
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
            'exists'                =>  'El valor seleccionado para el campo :attribute es invalido',
        ];
    }
}
