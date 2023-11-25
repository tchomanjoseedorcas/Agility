<?php

namespace App\Http\Requests\EmployeeRequest;

use App\Rules\UserUniqueNewValue;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $employee = $this->route()->parameter('employee');
        return [
            'lastname' => ['nullable', 'max:100'],
            'firstname' => ['nullable', 'max:100'],
            'email' => ['nullable', 'email', new UserUniqueNewValue('email', $employee?->email, $employee?->user_id)],
            'contact' => ['nullable', new UserUniqueNewValue('contact', $employee?->contact, $employee?->user_id)],
            'password' => ['nullable', Password::min(8), 'confirmed'],
            'photo' => ['nullable']
        ];
    }

    public function userAttributes(): array
    {
        $attributes = ['lastname', 'firstname', 'email', 'contact', 'password', 'photo'];

        if ($this->input('password')) {
            $this->merge(['password' => Hash::make($this->input('password'))]);
            $attributes[] = 'password';
        }

        return $this
            ->only($attributes);
    }
}
