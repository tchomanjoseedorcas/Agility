<?php

namespace App\Http\Requests\TaskRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status_id'  => ['nullable', 'exists:statuses,id'],
            'affected_to'  => ['nullable', 'exists:users,id'],
            'label'       => ['nullable', 'max:255'],
            'description' => ['nullable']
        ];
    }

    public function taskAttributes(): array {
        $attributes = ['status_id', 'affected_to', 'label', 'description'];
        return $this->only($attributes);
    }
}
