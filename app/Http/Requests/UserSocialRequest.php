<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSocialRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'regex:/^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/'],
            'email' => ['required_if:doemail', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => ['required', 'exists:TCG\Voyager\Models\Role,id'],
        ];
    }
}
