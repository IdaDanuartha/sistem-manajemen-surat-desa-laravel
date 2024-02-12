<?php

namespace App\Http\Requests\Letter\Sktm;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSktmRequest extends FormRequest
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
            "sk.reference_number" => "required",
            "sk.is_published" => "nullable",
            "sktm_type" => "required",
            "school_name" => "nullable",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "sktm_type" => "tipe sktm",
            "school_name" => "nama sekolah",
        ];
    }
}
