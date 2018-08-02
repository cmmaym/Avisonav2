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
            'reportsNumbers'           => 'required|max:500',
            'reportDate'               => 'required|date',
            'state'                     => 'sometimes|required|in:A,I',
            'file_info'                 => 'sometimes|nullable|file',
            'parent_id'                 => 'sometimes|required|exists:notice,id',
            'characterType'             => 'required|exists:character_type,id',
            'noveltyType'               => 'required|exists:novelty_type,id',
            'zone'                      => 'required|exists:zone,id',
            'catalogOceanCoast'         => 'nullable|exists:catalog_ocean_coast,id',
            'lightList'                 => 'nullable|exists:light_list,id',
            'reportSource'              => 'required|exists:report_source,id',
            'reportingUser'             => 'required|exists:reporting_user,id',
            'language'                  => 'sometimes|required|exists:language,id',
            'description'               => 'sometimes|required|max:500',
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
