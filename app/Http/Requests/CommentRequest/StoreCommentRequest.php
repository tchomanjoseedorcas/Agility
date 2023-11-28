<?php

namespace App\Http\Requests\CommentRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCommentRequest extends FormRequest
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
            'comment_id'  => ['required', 'exists:comments,id'],
            'content'    => ['required', 'max:255'],
            'created_by' => ['nullable'],
            
            // Add other validation rules as needed for your resource creation
        ];
    }

    /**
     * Get the resource attributes for the request.
     *
     * @return array
     */
    public function commentAttributes(): array
    {
        $attributes = ['comment_id', 'content', 'created_by'];

        
        return $this->merge($attributes)->only($attributes);
    }
}
