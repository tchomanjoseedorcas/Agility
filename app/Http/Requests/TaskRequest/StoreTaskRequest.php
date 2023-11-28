<?php

namespace App\Http\Requests\TaskRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'project_id'  => ['required', 'exists:projects,id'],
            'status_id'  => ['required', 'exists:statuses,id'],
            'affected_to'  => ['nullable', 'exists:users,id'],
            'label'       => ['required', 'max:255'],
            'description' => ['nullable']
        ];
    }

    /**
     * Get the resource attributes for the request.
     *
     * @return array
     */
    public function taskAttributes(): array
    {
        $attributes = ['project_id', 'status_id', 'affected_to', 'label', 'description'];
        return $this->only($attributes);
    }
}
