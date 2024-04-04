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
            "sk.cover_letter_number" => "required",
            "sk.is_published" => "nullable",
            "citizent_id" => "nullable",
            "school_name" => "nullable",
            "purpose" => "required"
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "sk.cover_letter_number" => "nomor SP kaling",
            "sktm_type" => "tipe sktm",
            "citizent_id" => "nama anak",
            "school_name" => "nama sekolah",
            "purpose" => "tujuan"
        ];
    }
}
