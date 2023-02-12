<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'email' => 'nullable|email|unique:clients,email,' . $this->route("client")->id,
            'phone' => 'nullable|regex:/^\+?[0-9]+$/|max:15|unique:clients,phone,' . $this->route("client")->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ];
    }
}
