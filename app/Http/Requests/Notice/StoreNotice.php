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
            'reportsNumbers'           => 'required|max:500',
            'reportDate'               => 'required|date_format:Y-m-d',
            'state'                     => 'sometimes|required|in:G,P',
            'location'                  => 'required|exists:location,id',
            'catalogOceanCoast'         => 'nullable|exists:catalog_ocean_coast,id',
            'lightList'                 => 'nullable|exists:light_list,id',
            'reportSource'              => 'required|exists:report_source,id',
            'reportingUser'             => 'required|exists:reporting_user,id',
            'description'               => 'sometimes|nullable|max:500',
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
            'date_format'           =>  'El campo :attribute no coincide con el formato :format'
        ];
    }
}
