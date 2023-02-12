<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|regex:/^\+?[0-9]+$/|max:15|unique:clients',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
}
