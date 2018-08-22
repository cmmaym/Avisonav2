<?php

namespace AvisoNavAPI\Http\Requests\Notice;

use Illuminate\Foundation\Http\FormRequest;

class StoreNovelty extends FormRequest
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
            'noveltyType'               => 'required|exists:novelty_type,id',
            'characterType'             => 'required|exists:character_type,id'
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
            'exists'                =>  'El valor seleccionado para el campo :attribute es invalido'
        ];
    }
}
