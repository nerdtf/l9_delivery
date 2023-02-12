<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class LoginClientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'sometimes|email',
            'phone' => 'sometimes|regex:/^\+?[0-9]+$/|max:15',
            'password' => 'required|string|min:8',
        ];
    }
}
