<?php

namespace App\Http\Requests\CommentRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
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
            'task_id'  => ['required', 'exists:tasks,id'],
            'content'    => ['required', 'max:255']
        ];
    }

    /**
     * Get the resource attributes for the request.
     *
     * @return array
     */
    public function commentAttributes(): array
    {
        $attributes = ['task_id', 'content', 'created_by'];
        return $this->merge(['created_by' => Auth::id()])->only($attributes);
    }
}
