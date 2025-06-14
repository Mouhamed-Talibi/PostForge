<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostSearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('creator')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required', 
                'string',
                'max:100',
                'regex:/^[a-zA-Z0-9\s]+$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.title' => 'You must enter the post title to find it !',
            'title.string' => 'Search term must be text',
            'title.max' => 'Search term cannot exceed 100 characters',
            'title.regex' => 'Only letters and numbers are allowed (no symbols or punctuation)'
        ];
    }
}
