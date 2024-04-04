<?php

namespace App\Http\Requests\Letter\SkName;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkNameRequest extends FormRequest
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
            "national_identify_number_other" => "required",
            "national_identify_number_listed" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "sk.cover_letter_number" => "nomor SP kaling",
            "national_identify_number_other" => "NIK yang berbeda",
            "national_identify_number_listed" => "NIK tercantum",
        ];
    }
}
