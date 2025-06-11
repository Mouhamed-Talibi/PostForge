<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'post_title' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'required|string|regex:/^[a-zA-Z0-9\s.,!?]+$/',
            'category' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    /**
     * Get custom validation messages for the defined rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'post_title.regex' => 'The title may only contain letters, numbers, and spaces.',
            'description.regex' => 'The description may only contain letters, numbers, spaces, and basic punctuation.',
            'category.min' => 'Please select a valid category.',
            'image.max' => 'The image must not exceed 2MB in size.',
            'image.mimes' => 'The image must be a file of type: jpg, jpeg, png, or gif.',
        ];
    }
}
