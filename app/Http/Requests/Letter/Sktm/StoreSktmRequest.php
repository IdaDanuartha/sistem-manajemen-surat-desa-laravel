<?php

namespace App\Http\Requests\Letter\Sktm;

use Illuminate\Foundation\Http\FormRequest;

class StoreSktmRequest extends FormRequest
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
            "sk.citizent_id" => "required",
            "sk.reference_number" => "required",
            "sk.is_published" => "nullable",
            "sktm_type" => "required",
            "citizent_id" => "nullable",
            "school_name" => "nullable",
            "purpose" => "required"
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "sktm_type" => "tipe sktm",
            "citizent_id" => "nama anak",
            "school_name" => "nama sekolah",
            "purpose" => "tujuan"
        ];
    }
}
