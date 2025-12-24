<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email',
            'phone' => 'required|string|size:10|regex:/^[0-9]{10}$/',
            'address' => 'string|nullable',
            'password' => 'required|string|min:6',
            'zip' => 'required|size:6|regex:/^[0-9]{6}$/',
            'imageUrl' => 'image|mimes:png,jpg,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'imageUrl.image' => 'Image must be image',
            'imageUrl.mimes' => 'Image must be .jpg, .png and .jpeg only'
        ];
    }
}
