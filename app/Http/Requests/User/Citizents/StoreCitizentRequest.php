<?php

namespace App\Http\Requests\User\Citizents;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCitizentRequest extends FormRequest
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
			'name' => ['required', Rule::unique('citizents', 'name')],			
			'environmental_id' => ['required'],			
			'national_identify_number' => ['required', Rule::unique('citizents', 'national_identify_number')],			
			'family_card_number' => ['required'],			
			'phone_number' => ['nullable', 'min:10', 'max:13'],			
			'gender' => ['required'],			
			'birth_place' => ['required'],			
			'birth_date' => ['required'],			
			'blood_group' => ['required'],			
			'religion' => ['required'],			
			'marital_status' => ['required'],			
			'citizenship' => ['nullable'],			
			'work' => ['nullable'],			
			'address' => ['nullable'],
            'id_card_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'family_card_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'birth_certificate_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'marriage_certificate_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'land_certificate_file' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,svg,webp', 'max:2000'],
			'user.email' => ['required', 'email', Rule::unique('users', 'email')],
			'user.password' => ['required', 'min:6'],
			'user.status' => ['nullable'],
			'user.signature_image' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,gif,svg,webp', 'max:2000'],			
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'nama',
            'environmental' => 'lingkungan',
            'national_identify_number' => 'nik',
            'family_card_number' => 'nomor kartu keluarga',
            'phone_number' => 'nomor hp',
            'birth_place' => 'tempat lahir',
            'birth_date' => 'tanggal lahir',
            'blood_group' => 'golongan darah',
            'religion' => 'agama',
            'marital_status' => 'status pernikahan',
            'citizenship' => 'kewarganegaraan',
            'work' => 'pekerjaan',
            'address' => 'alamat',
            'user.email' => 'email',
            'user.password' => 'password',
            'user.status' => 'status',
            'user.signature_image' => 'tanda tangan elektronik',            
        ];
    }
}
