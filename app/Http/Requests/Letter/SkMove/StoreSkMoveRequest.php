<?php

namespace App\Http\Requests\Letter\SkMove;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkMoveRequest extends FormRequest
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
            "sk_move_type" => "required",
            "reason" => "required",
            "moving_address" => "required",
            "sk_move_type" => "required",
            "family_citizent_id" => "nullable",
            "family_relationship_status" => "nullable",
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
            "family_citizent_id" => "keluarga yang pindah",
            "family_relationship_status" => "status hubungan",
        ];
    }
}
