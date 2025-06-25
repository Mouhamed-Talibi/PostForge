<?php

namespace App\Http\Requests;

use App\Models\Creator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateadminEmail extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('creator')->check()
            && auth('creator')->user()->id = $this->route('id');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $adminId = $this->route('id');
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:creators,email,'.$adminId
            ],
            'email_confirmation' => [
                'required',
                'email',
                'same:email'
            ],
            'password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $admin = Creator::findOrFail($this->route('id'));
                    if (!Hash::check($value, $admin->password)) {
                        $fail('The current password is incorrect.');
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'The new email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already in use by another account.',
            'email_confirmation.same' => 'Email confirmation does not match.',
            'password.required' => 'Your current password is required to change email.'
        ];
    }
}
