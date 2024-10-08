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
			'name' => ['nullable'],
			'national_identify_number' => ['nullable', Rule::unique('citizents', 'national_identify_number')->ignore(auth()->user()->authenticatable->citizent->id ?? auth()->user()->authenticatable->id)],
			'employee_number' => ['nullable'],			
			'position' => ['nullable'],			
			'family_card_number' => ['nullable'],			
			'phone_number' => ['nullable', 'min:10', 'max:13'],			
			'phone' => ['nullable', 'min:10', 'max:13'],			
			'gender' => ['nullable'],
			'birth_place' => ['nullable'],
			'birth_date' => ['nullable'],
			'blood_group' => ['nullable'],
			'religion' => ['nullable'],			
			'marital_status' => ['nullable'],
			'id_card_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'family_card_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'birth_certificate_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'marriage_certificate_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'land_certificate_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'user.username' => ['nullable', 'alpha_dash', Rule::unique('users', 'username')->ignore(auth()->id())],
			'user.email' => ['nullable', 'email', Rule::unique('users', 'email')->ignore(auth()->id())],
			'user.password' => ['nullable', 'min:6'],
			'user.signature_image' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'user.profile_image' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],			
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nama',
            'employee_number' => 'nip',
            'position' => 'jabatan',
            'national_identify_number' => 'nik',
            'family_card_number' => 'nomor kartu keluarga',
            'phone_number' => 'nomor hp',
            'phone' => 'nomor hp',
            'birth_place' => 'tempat lahir',
            'birth_date' => 'tanggal lahir',
            'blooigion' => 'agama',
            'mard_group' => 'golongan darah',
            'relital_status' => 'status pernikahan',
            'user.username' => 'username',
            'user.email' => 'email',
            'user.password' => 'password',            
            'user.profile_image' => 'foto profil',
        ];
    }
}
