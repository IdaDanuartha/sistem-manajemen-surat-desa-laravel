<?php

namespace App\Http\Requests\Letter\SkParentIncome;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkParentIncomeRequest extends FormRequest
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
            "citizent_id" => "required",
            "income" => "nullable|numeric",
            "status" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "sk.cover_letter_number" => "nomor SP kaling",
            "citizent_id" => "nama anak",
            "income" => "penghasilan",
        ];
    }
}
