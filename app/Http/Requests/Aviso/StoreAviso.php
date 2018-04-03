<?php

namespace AvisoNavAPI\Http\Requests\Aviso;

use Illuminate\Foundation\Http\FormRequest;

class StoreAviso extends FormRequest
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
            'num_aviso'                 => 'required|max:100',
            'fecha'                     => 'required|date',            
            'entidad_id'                => 'required|exists:entidad,id',
            'aviso.*.observacion'       => 'required|string',
            'aviso.*.tipo_aviso_id'     => 'required|exists:tipo_aviso,id',
            'aviso.*.tipo_caracter_id'  => 'required|exists:tipo_caracter,id',
            'aviso.*.idioma_id'         => 'required|exists:idioma,id',
            'aviso'                     => 'idioma_duplicate',
            'carta.*'                   => 'required|exists:carta,id',
            'ayuda.*.id'                => 'required|exists:ayuda,id',
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
            'idioma_duplicate'      =>  'Registros con idioma duplicado',
        ];
    }
}
