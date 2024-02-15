<?php

namespace App\Http\Requests\Letter\SkPowerAttorney;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkPowerAttorneyRequest extends FormRequest
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
            "citizent_id" => "required",
            "date_of_death" => "required",
            "power_attorney_family" => "required",
            "power_attorney_relationship_status" => "required"
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "citizent_id" => "pemberi warisan",
            "date_of_death" => "tanggal meninggal",
            "power_attorney_family" => "ahli waris",
            "power_attorney_relationship_status" => "status hubungan"
        ];
    }
}
