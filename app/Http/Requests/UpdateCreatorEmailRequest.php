<?php

namespace App\Http\Requests;

use App\Models\Creator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCreatorEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Creator $creator): bool
    {
        return auth('creator')->id() == $this->route('creator')->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:creators,email',
        ];
    }

    public function messages() {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered. try new email !',
        ];
    }
}
