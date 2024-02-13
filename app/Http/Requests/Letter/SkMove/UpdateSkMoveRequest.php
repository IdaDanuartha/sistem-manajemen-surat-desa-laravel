<?php

namespace App\Http\Requests\Letter\SkMove;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkMoveRequest extends FormRequest
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
            "sk_move_type" => "required",
            "reason" => "required",
            "moving_address" => "required",
            "sk_move_family.citizent_id" => "required",
            "sk_move_family.relationship_status" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "citizent_id" => "kepala keluarga",
            "sk_move_type" => "jenis",
            "reason" => "alasan",
            "moving_address" => "alamat pindah",
            "sk_move_family.citizent_id" => "keluarga yang pindah",
            "sk_move_family.relationship_status" => "status hubungan",
        ];
    }
}
