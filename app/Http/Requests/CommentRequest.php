<?php

namespace App\Http\Requests;

use App\Models\Creator;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Creator $creator): bool
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
            'content' => [
                'nullable',
                'string',
                'max:1000',
                'regex:/^[\pL\pN\s.,!?]+$/u'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'content.regex' => 'The content may only contain letters, numbers, spaces, and special characters like !, ?, ., ,',
        ];
    }

}
