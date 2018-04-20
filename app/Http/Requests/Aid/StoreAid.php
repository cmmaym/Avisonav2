<?php

namespace AvisoNavAPI\Http\Requests\Aid;

use Illuminate\Foundation\Http\FormRequest;

class StoreAid extends FormRequest
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
            'number'                      => 'nullable|integer',
            'sub_name'                    => 'required|max:100',
            'state'                       => 'sometimes|required|in:A,I',
            'aid_type_id'                 => 'required|exists:aid_type,id',
            'location_id'                 => 'required|exists:location,id'
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
