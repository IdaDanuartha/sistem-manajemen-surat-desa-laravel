<?php

namespace App\Http\Requests\User\EnvironmentalHeads;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnvironmentalHeadRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => "required|unique:environmental_heads,name",
            'environmental_id' => "required",
            'user.email' => 'required|email|unique:users,email',
			'user.password' => 'required|min:6',
			'user.status' => 'nullable',
			'user.signature_image' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2000',	
        ];
    }
    
    public function attributes()
    {
        return [
            'name' => 'nama',
            'environmental_id' => 'lingkungan',
            'user.email' => 'email',
            'user.password' => 'password',
            'user.status' => 'status',
            'user.signature_image' => 'tanda tangan elektronik',            
        ];
    }
}
