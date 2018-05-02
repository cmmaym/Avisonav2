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
            'elevation'                   => 'required|integer',
            'scope'                       => 'required|integer',
            'quantity'                    => 'required|integer',
            'observation'                 => 'required',
            'state'                       => 'sometimes|required|in:A,I',
            'aid_type_id'                 => 'required|exists:aid_type,id',
            'location_id'                 => 'required|exists:location,id',
            'light_type_id'               => 'required|exists:light_type,id',
            'color_type_id'               => 'required|exists:color_type,id'
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
