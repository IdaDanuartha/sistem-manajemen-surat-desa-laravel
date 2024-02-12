<?php

namespace App\Http\Requests\Letter\SkDomicile;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkDomicileRequest extends FormRequest
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
            "citizent_id" => "required",
            "community_group" => "required",
            "position" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "citizent_id" => "nama warga",
            "position" => "jabatan",
            "community_group" => "kelompok masyarakat",
        ];
    }
}
