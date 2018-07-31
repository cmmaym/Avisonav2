<?php

namespace AvisoNavAPI\Http\Requests\LightList;

use Illuminate\Foundation\Http\FormRequest;

class StoreLightList extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'edition'       => 'required|string',
            'year'          => 'required|string',
        ];
    }
}
