<?php

namespace AvisoNavAPI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserType extends FormRequest
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
            'num_ide'           => 'required|integer',
            'user_name'         => 'required|unique:user,user_name,'.$this->user->id,
            'name1'             => 'required',
            'name2'             => 'nullable',
            'last_name1'        => 'required',
            'last_name2'        => 'required',
            'email'             => 'required|email|unique:user,email,'.$this->user->id,
            'password'          => 'present|confirmed|min:8',
            'state'             => 'sometimes|in:A,I',
            'role_id'           => 'required|exists:role,id'
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
            'min'                   =>  'El campo :attribute debe tener minimo :min caracteres',
            'unique'                =>  'El :attribute ya esta en uso'
        ];
    }
}
