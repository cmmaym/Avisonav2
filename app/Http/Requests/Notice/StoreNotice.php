<?php

namespace AvisoNavAPI\Http\Requests\Notice;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotice extends FormRequest
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
            'number'                    => 'required|max:100',
            'date'                      => 'required|date',
            'state'                     => 'sometimes|required|in:A,I',
            'file_info'                 => 'sometimes|required|file',
            'entity_id'                 => 'required|exists:entity,id',
            'parent_id'                 => 'sometimes|required|exists:notice,id'
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
