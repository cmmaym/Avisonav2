<?php

namespace AvisoNavAPI\Http\Requests\TopMark;

use Illuminate\Foundation\Http\FormRequest;

class StoreTopMarkImage extends FormRequest
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
            'file'           => 'required|file|image|max:10000'
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
            'max'               => [
                'string'    => 'El campo :attribute debe tener maximo :max caracteres',
                'file'      => 'El archivo debe tener un peso de maximo :max kilobytes'
            ]
        ];
    }
}
