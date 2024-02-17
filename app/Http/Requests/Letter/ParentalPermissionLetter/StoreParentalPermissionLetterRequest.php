<?php

namespace App\Http\Requests\Letter\ParentalPermissionLetter;

use Illuminate\Foundation\Http\FormRequest;

class StoreParentalPermissionLetterRequest extends FormRequest
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
            // "sk.reference_number" => "required",
            "sk.is_published" => "nullable",
            "citizent_id" => "required",
            "relationship_status" => "required",
            "description" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "citizent_id" => "nama yang izin",
            "relationship_status" => "status hubungan",
            "description" => "deskripsi",
        ];
    }
}
