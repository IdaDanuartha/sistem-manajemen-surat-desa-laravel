<?php

namespace App\Http\Requests\Letter\SkGrant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkGrantRequest extends FormRequest
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
            // "sk.reference_number" => "required",
            "sk.is_published" => "nullable",
            "citizent_id" => "required",
            "police_number" => "required",
            "owner_name" => "required",
            "address" => "required",
            "brand" => "required",
            "type" => "required",
            "model" => "required",
            "production_year" => "required",
            "cylinder_filling" => "required",
            "frame_number" => "required",
            "machine_number" => "required",
            "bpkb_number" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "citizent_id" => "warga penerima hibah",
            "police_number" => "nomor polisi",
            "owner_name" => "nama pemilik",
            "address" => "alamat",
            "brand" => "merk",
            "type" => "jenis",            
            "production_year" => "tahun produksi",
            "cylinder_filling" => "isi selinder",
            "frame_number" => "no. rangka",
            "machine_number" => "no. mesin",
            "bpkb_number" => "no. bpkb",
        ];
    }
}
