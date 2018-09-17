<?php

namespace AvisoNavAPI\Http\Requests\Coordinate;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoordinate extends FormRequest
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
            'latitude'           => 'required|numeric|between:-90,90',
            'longitude'           => 'required|numeric|between:-180,180'
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
        ];
    }
    
}
