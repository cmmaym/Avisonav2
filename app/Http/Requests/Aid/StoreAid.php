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
            'name'                        => 'sometimes|required|max:100',
            'racon'                       => 'max:10',
            'ais'                         => 'nullable|max:100',
            'height'                      => 'required|max:45',
            'elevationNmm'                => 'required|max:45',
            'scope'                       => 'required|max:45',
            'flashGroups'                 => 'required|numeric',
            'period'                      => 'required|max:45',
            'location'                    => 'required|exists:location,id',
            'lightClass'                  => 'required|exists:light_class,id',
            'colorStructurePattern'       => 'sometimes|required|exists:color_structure,id',
            'topMark'                     => 'nullable|exists:top_mark,id',
            'aidType'                     => 'required|exists:aid_type,id',
            'aidTypeForm'                 => 'required|exists:aid_type_form,id',
            'observation'                 => 'sometimes|nullable'
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
            'max'                   =>  'El campo :attribute debe tener maximo :max caracteres',
        ];
    }
}
