<?php

namespace App\Http\Requests\Letter\SkInheritanceDistribution;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkInheritanceDistributionRequest extends FormRequest
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
            "surface_area" => "required|numeric",
            "family_citizent_id" => "nullable"
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "surface_area" => "luas tanah",
            "family_citizent_id" => "keluarga yang mendapat warisan"
        ];
    }
}
