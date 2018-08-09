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
            'latitudeDegrees'           => 'required|numeric',
            'latitudeMinutes'           => 'required|numeric',
            'latitudeSeconds'           => 'required|numeric',
            'latitudeDir'               => 'required',
            'longitudeDegrees'           => 'required|numeric',
            'longitudeMinutes'           => 'required|numeric',
            'longitudeSeconds'           => 'required|numeric',
            'longitudeDir'               => 'required',
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
