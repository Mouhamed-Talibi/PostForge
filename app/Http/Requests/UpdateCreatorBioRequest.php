<?php

namespace App\Http\Requests;

use App\Models\Creator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCreatorBioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Creator $creator): bool
    {
        return auth('creator')->id() === $this->route('creator')->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bio' => 'nullable|string|max:1000|regex:/^[\pL\pN\pM\s\-\'\.,;!?()"]+$/u',
        ];
    }

    public function messages() {
        return [
            'bio.string' => 'The bio must be a text (Chars).',
            'bio.max' => 'The bio cannot exceed 1000 characters.',
            'bio.regex' => 'The bio contains invalid characters. Only letters, numbers, spaces, and basic punctuation are allowed.',
        ];
    }
}
