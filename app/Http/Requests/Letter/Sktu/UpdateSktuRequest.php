<?php

namespace App\Http\Requests\Letter\Sktu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSktuRequest extends FormRequest
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
            "business_name" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "sk.cover_letter_number" => "nomor SP kaling",
            "business_name" => "nama usaha",
        ];
    }
}
