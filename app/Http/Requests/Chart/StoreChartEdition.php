<?php

namespace AvisoNavAPI\Http\Requests\Chart;

use Illuminate\Foundation\Http\FormRequest;

class StoreChartEdition extends FormRequest
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
            'number'        => 'required|integer',
            'year'          => 'required|integer',
            'state'         => 'sometimes|required|required|in:A,I'
        ];
    }
}
