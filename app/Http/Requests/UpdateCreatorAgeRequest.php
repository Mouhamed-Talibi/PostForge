<?php

namespace App\Http\Requests;

use App\Models\Creator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCreatorAgeRequest extends FormRequest
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
            'age' => 'required|integer|min:18|max:100',
        ];
    }

    public function messages() {
        return [
            'age.required' => 'Please enter your age.',
            'age.integer' => 'Age must be a number.',
            'age.min' => 'You must be at least 18 years old to register.',
            'age.max' => 'Please enter a valid age below 100.',
        ];
    }
}
