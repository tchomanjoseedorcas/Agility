<?php

namespace App\Http\Requests\CommentRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateCommentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<string>|string>
     */
    public function rules(): array
    {
        return [
            'content' => ['nullable']
        ];
    }

    /**
     * Get the resource attributes for the request.
     *
     * @return array
     */
    public function commentAttributes(): array
    {
        $attributes = ['content'];
        return $this->only($attributes);
    }
}
