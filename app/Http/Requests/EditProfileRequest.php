<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'name' => 'string|regex:/^[a-zA-Z\s]+$/',
            'email' => 'email',
            'phone' => 'string|size:10|regex:/^[0-9]{10}$/',
            'address' => 'string|nullable',
            'password' => 'string|min:6',
            'zip' => 'size:6|regex:/^[0-9]{6}$/',
            'imageUrl' => 'image|mimes:png,jpg,jpeg',
        ];
    }
}
