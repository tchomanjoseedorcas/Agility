<?php

namespace App\Http\Requests\ResourceRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Set to true to authorize all users for now; you can modify this based on your authentication logic.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'project_id'  => ['required', 'exists:projects,id'],
            'label'       => ['required', 'max:255'],
            'description' => ['nullable'],
            'budget'      => ['nullable', 'numeric', 'min:0'],
        ];
    }

    /**
     * Get the resource attributes for the request.
     *
     * @return array
     */
    public function resourceAttributes(): array
    {
        $attributes = ['project_id', 'label', 'description', 'budget'];

        $defaults = [
            'user_id'   => Auth::id(),
        ];

        return $this->merge($defaults)->only($attributes);
    }
}
