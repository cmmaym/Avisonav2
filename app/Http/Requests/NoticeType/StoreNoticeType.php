<?php

namespace AvisoNavAPI\Http\Requests\NoticeType;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoticeType extends FormRequest
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
            'name'         => 'required|max:100',
            'state'        => 'required|required|in:A,I',
            'language_id'  => 'required|integer|exists:language,id',
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
        ];
    }
}