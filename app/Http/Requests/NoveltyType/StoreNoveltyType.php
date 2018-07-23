<?php

namespace AvisoNavAPI\Http\Requests\NoveltyType;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoveltyType extends FormRequest
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
            'state'        => 'sometimes|required|in:A,I',
            'name'         => 'sometimes|required|max:100',
            'language'  => 'sometimes|required|integer|exists:language,id',
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
