<?php

namespace App\Http\Requests\Letter\SkDie;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkDieRequest extends FormRequest
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
            "year" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "citizent_id" => "orang yang meninggal",
            "year" => "tahun meninggal",
        ];
    }
}
