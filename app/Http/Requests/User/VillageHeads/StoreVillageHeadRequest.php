<?php

namespace App\Http\Requests\User\VillageHeads;

use Illuminate\Foundation\Http\FormRequest;

class StoreVillageHeadRequest extends FormRequest
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
            'name' => "required|unique:village_heads,name",
            'employee_number' => "required",
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
            'employee_number' => 'nip',
            'user.email' => 'email',
            'user.password' => 'password',
            'user.status' => 'status',
            'user.signature_image' => 'tanda tangan elektronik',            
        ];
    }
}
