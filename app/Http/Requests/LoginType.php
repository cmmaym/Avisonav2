<?php

namespace AvisoNavAPI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginType extends FormRequest
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
            'email'     => 'required|email|exists:user,email',
            'password'  => 'required'
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
            'email'                 =>  'El email debe ser una direccion de email valida',
            'exists'                =>  'El valor ingresado en el campo :attribute no existe',
        ];
    }
}
