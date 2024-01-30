<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
			'name' => ['nullable', Rule::unique('citizents', 'name')->ignore(auth()->id())],
			'national_identify_number' => ['nullable', Rule::unique('citizents', 'national_identify_number')->ignore(auth()->id())],
			'family_card_number' => ['nullable'],			
			'phone_number' => ['nullable', 'min:10', 'max:13'],			
			'gender' => ['nullable'],
			'birth_place' => ['nullable'],
			'birth_date' => ['nullable'],
			'blood_group' => ['nullable'],
			'religion' => ['nullable'],			
			'marital_status' => ['nullable'],			
			'profile_image' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,gif,svg,webp', 'max:2000'],			
			'user.email' => ['nullable', 'email:dns', Rule::unique('users', 'email')->ignore(auth()->id())],
			'user.password' => ['nullable', 'min:6'],
			'user.status' => ['nullable'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nama',
            'national_identify_number' => 'nik',
            'family_card_number' => 'nomor kartu keluarga',
            'phone_number' => 'nomor hp',
            'birth_place' => 'tempat lahir',
            'birth_date' => 'tanggal lahir',
            'blood_group' => 'golongan darah',
            'religion' => 'agama',
            'marital_status' => 'status pernikahan',
            'profile_image' => 'foto profil',
            'user.email' => 'email',
            'user.password' => 'password',
            'user.status' => 'status',
        ];
    }
}
