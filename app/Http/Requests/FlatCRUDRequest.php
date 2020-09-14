<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlatCRUDRequest extends FormRequest
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
            'street' => 'required|string|min:3|max:255',
            'city' => 'required|string|min:3|max:255',
            'house_number' => 'required|string|min:1|max:10',
            'description' => 'required|string|min:3|max:5000',
            'price' => 'required|numeric|min:1|max:10000000',
            'floor' => 'required|integer|min:1|max:1000',
            'area' => 'required|integer|min:1|max:10000',
            'living_area' => 'required|integer|min:1|max:10000',
            'number_of_rooms' => 'required|integer|min:1|max:1000',
            'type_of_premises' => 'required|in:Частный дом,Квартира,Комната',
            'rental_period' => 'required|in:Посуточно,Помесячно',
            'photos.*' => 'image',
        ];
    }
}
