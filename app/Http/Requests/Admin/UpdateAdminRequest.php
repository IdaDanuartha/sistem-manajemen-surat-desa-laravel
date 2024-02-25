<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRequest extends FormRequest
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
			'name' => ['required', Rule::unique('admins', 'name')->ignore($this->admin->id)],		
			'user.username' => ['required', 'alpha_dash', Rule::unique('users', 'username')->ignore($this->admin->user->id)],
			'user.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->admin->user->id)],
			'user.password' => ['nullable', 'min:6'],
			'user.status' => ['nullable'],
			'user.profile_image' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,gif,svg,webp', 'max:2000'],			
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nama',
            'user.username' => 'username',
            'user.email' => 'email',
            'user.password' => 'password',
            'user.status' => 'status',
            'user.profile_image' => 'foto profil',
        ];
    }
}
