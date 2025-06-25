<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostQueryByAdmin extends FormRequest
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
            'query' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-\.,!?\'\"]+$/'
        ];
    }

    public function messages() {
        return [
            'query.regex' => "Only letters, spaces and basic symbols allowed! Try again",
        ];
    }
}
