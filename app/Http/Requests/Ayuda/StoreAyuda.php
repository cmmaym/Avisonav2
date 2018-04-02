<?php

namespace AvisoNavAPI\Http\Requests\Ayuda;

use Illuminate\Foundation\Http\FormRequest;

class StoreAyuda extends FormRequest
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
            'numero'                    => 'required|integer',
            'nombre'                    => 'required|max:100',
            'estado'                    => 'sometimes|required|in:A,I',
            'latitud'                   => 'required|string',
            'longitud'                  => 'required|string',
            'altitud'                   => 'required|integer',
            'alcance'                   => 'required|integer',
            'cantidad'                  => 'required|integer',
            'detalle.*.descripcion'     => 'required|string',
            'detalle.*.observacion'     => 'required|string',
            'detalle.*.tipo_luz_id'     => 'required|exists:tipo_aviso,id',
            'detalle.*.tipo_color_id'   => 'required|exists:tipo_color,id',
            'detalle.*.idioma_id'       => 'required|exists:idioma,id',
            'detalle'                   => 'idioma_duplicate',
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
