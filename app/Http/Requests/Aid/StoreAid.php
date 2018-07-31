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
            'name'                        => 'required|max:100',
            'elevation'                   => 'required|integer',
            'scope'                       => 'required|integer',
            'features'                    => 'required',
            'observation'                 => 'required',
            'description'                 => 'required',
            'aidType'                     => 'required|exists:aid_type,id',
            'location'                    => 'required|exists:location,id',
            'lightType'                   => 'required|exists:light_type,id',
            'colorType'                   => 'required|exists:color_type,id'
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
