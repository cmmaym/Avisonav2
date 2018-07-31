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
            'state'                     => 'sometimes|required|in:A,I',
            'file_info'                 => 'sometimes|nullable|file',
            'entity'                    => 'required|exists:entity,id',
            'characterType'             => 'required|exists:character_type,id',
            'noveltyType'               => 'required|exists:novelty_type,id',
            'language'                  => 'sometimes|required|exists:language,id',
            'observation'               => 'required',
            'parent_id'                 => 'sometimes|required|exists:notice,id',
            'zone'                      => 'required|exists:zone,id',
            'catalogOceanCoast'         => 'nullable|exists:catalog_ocean_coast,id',
            'lightList'                 => 'nullable|exists:light_list,id',
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
