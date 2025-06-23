<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                'min:5',
                'regex:/^[\pL\s\-,.!?()"\']+$/u' 
            ],
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', 
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required',
            'name.string' => 'The name must be a valid text',
            'name.max' => 'The name cannot exceed 255 characters',
            'name.min' => 'The name must be at least 5 characters',
            'name.regex' => 'The name contains invalid characters. Only letters, spaces, and basic punctuation (-,.!?()"\') are allowed',
            
            'image.image' => 'The file must be an image',
            'image.mimes' => 'Only JPG, PNG, and JPEG formats are allowed',
            'image.max' => 'The image size cannot exceed 2MB',
        ];
    }
}
