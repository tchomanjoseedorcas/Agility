<?php

namespace App\Http\Requests\StatusRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreStatusRequest extends FormRequest
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
            'status_id'  => ['required', 'exists'],
            'label'       => ['required', 'max:255'],
           
            // Add other validation rules as needed for your resource creation
        ];
    }

    /**
     * Get the resource attributes for the request.
     *
     * @return array
     */
    public function statusAttributes(): array
    {
        $attributes = ['project_id', 'label'];

        
        return $this->merge($attributes)->only($attributes);
    }
}
