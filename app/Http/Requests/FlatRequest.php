<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlatRequest extends FormRequest
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
            'price' => 'integer|min:1|max:10000000',
            'date_start' => 'date|after_or_equal:today|date_format:Y-m-d',
            'date_end' => 'date|after:date_start|date_format:Y-m-d'
        ];
    }
}
