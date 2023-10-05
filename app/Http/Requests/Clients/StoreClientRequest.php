<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\CustomValidationException;
use Illuminate\Contracts\Validation\Validator;

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
            'first_name' => 'string|max:255',
            'last_name' => 'string|max:255',
            'address' => 'required|string',
            'email' => 'required|email|unique:clients',
            'phone' => 'required|regex:/^\+?[0-9]+$/|max:15|unique:clients',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.string' => 'First name must be a string.',
            'first_name.max' => 'First name cannot be longer than 255 characters.',


            'address.required' => 'Address is required.',
            'address.string' => 'Address must be a string.',

            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already in use.',

            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Please enter a valid phone number format.',
            'phone.max' => 'Phone number cannot be longer than 15 characters.',
            'phone.unique' => 'This phone number is already in use.',

            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, or svg.',
            'image.max' => 'The image size must not exceed 2048 kilobytes.',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new CustomValidationException($validator);
    }
}
