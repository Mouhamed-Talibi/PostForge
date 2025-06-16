<?php

namespace App\Http\Requests;

use App\Models\Creator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCreatorNameRequest extends FormRequest
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
            'creator_name' => 'required|string|min:6|max:60',
        ];
    }

    public function messages() {
        return [
            'creator_name.required' => 'Please enter your full name.',
            'creator_name.string' => 'Your name must be valid text.',
            'creator_name.min' => 'Your name must be at least 6 characters.',
            'creator_name.max' => 'Your name cannot be more than 60 characters.',
        ];
    }
}
