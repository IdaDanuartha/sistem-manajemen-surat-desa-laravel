<?php

namespace App\Http\Requests\Letter\SkInheritanceDistribution;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkInheritanceDistributionRequest extends FormRequest
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
            // "citizent_id" => "required",
            "certificate_number" => "required",
            "surface_area" => "required|numeric",
            "inheritance_distribution_family" => "required",
            "inheritance_distribution_area" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "certificate_number" => "nomor sertifikat hak milik",
            // "citizent_id" => "penerima kuasa",
            "surface_area" => "luas tanah",
            "inheritance_distribution_family" => "keluarga yang mendapat warisan",
            "inheritance_distribution_area" => "pembagian luas tanah"
        ];
    }
}
