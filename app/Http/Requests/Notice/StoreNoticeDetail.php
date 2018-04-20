<?php

namespace AvisoNavAPI\Http\Requests\Notice;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoticeDetail extends FormRequest
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
            'observation'               => 'required',
            'state'                     => 'sometimes|required|in:A,I',
            'character_type_id'         => 'required|exists:character_type,id',
            'language_id'               => 'required|exists:language,id',
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
            'exists'                =>  'El valor seleccionado para el campo :attribute es invalido'
        ];
    }

}
