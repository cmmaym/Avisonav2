<?php

namespace AvisoNavAPI\Http\Requests\Chart;

use Illuminate\Foundation\Http\FormRequest;

class StoreChart extends FormRequest
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
            'number'        => 'required|string',
            'purpose'       => 'required|string',
            'state'         => 'sometimes|required|required|in:A,I'
        ];
    }
}
