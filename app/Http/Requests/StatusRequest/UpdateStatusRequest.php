<?php

namespace App\Http\Requests\StatusRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateStatusRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<string>|string>
     */
    public function rules(): array
    {
        return [
            'status_id'  => ['sometimes', 'required',],
            'label'       => ['sometimes', 'required', 'max:255'],
           
        ];
    }

    /**
     * Get the resource attributes for the request.
     *
     * @return array
     */
    public function statusAttributes(): array
    {
        $attributes = ['status_id', 'label'];

       

        return $this->merge($attributes)->only($attributes);
    }
}
