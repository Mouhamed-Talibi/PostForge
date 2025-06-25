<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminProfile extends FormRequest
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
            'creator_name' => 'required|string|min:6|max:60',
            'gender' => 'required|in:male,female',
            'age' => 'required|integer|min:18|max:100',
            'image' => 'nullable|image|max:2048',
            'bio' => 'nullable|string|max:1000|regex:/^[\pL\pN\pM\s\-\'\.,;!?()"]+$/u',
        ];
    }

    public function messages(): array
        {
            return [
                'creator_name.required' => 'Please enter your full name.',
                'creator_name.string' => 'Your name must be valid text.',
                'creator_name.min' => 'Your name must be at least 6 characters.',
                'creator_name.max' => 'Your name cannot be more than 60 characters.',

                'gender.required' => 'Please select your gender.',
                'gender.in' => 'Gender must be either "male" or "female".',

                'age.required' => 'Please enter your age.',
                'age.integer' => 'Age must be a number.',
                'age.min' => 'You must be at least 18 years old to register.',
                'age.max' => 'Please enter a valid age below 100.',

                'image.image' => 'Please upload a valid image file.',
                'image.max' => 'Image size must not exceed 2MB.',

                'bio.string' => 'The bio must be a text (Chars).',
                'bio.max' => 'The bio cannot exceed 1000 characters.',
                'bio.regex' => 'The bio contains invalid characters. Only letters, numbers, spaces, and basic punctuation are allowed.',
            ];
        }
}
