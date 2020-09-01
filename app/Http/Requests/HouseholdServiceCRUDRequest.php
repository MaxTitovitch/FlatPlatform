<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseholdServiceCRUDRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'city' => 'required|string|min:3|max:255',
            'description' => 'required|text|min:10|max:5000',
            'price' => 'required|numeric|min:1|max:10000000',
            'household_service_category_id' => 'required|exists:App\HouseholdServiceCategory,id',
        ];
    }
}
