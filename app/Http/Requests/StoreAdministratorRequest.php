<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class StoreAdministratorRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lastname' => ['required', 'max:100'],
            'firstname' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users'],
            'contact' => ['nullable', 'unique:users,contact'],
            'password' => ['required', Password::min(8),'confirmed'],
            'photo' => ['nullable']
        ];
    }

    public function userAttributes(): array
    {
        $attributes = ['lastname', 'firstname', 'email', 'email', 'contact', 'password', 'photo'];
        return $this
            ->merge(['password' => Hash::make('password')])
            ->only($attributes);
    }

    public function administratorAttributes(string $userId): array
    {
        return $this
            ->merge(['user_id' => $userId])
            ->only(['user_id']);
    }
}
