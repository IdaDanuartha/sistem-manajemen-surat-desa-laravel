<?php

namespace App\Http\Requests\Letter\DieselPurchaseLetter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDieselPurchaseRequest extends FormRequest
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
            "business_address" => "required",
            "purpose" => "required",
            "requirement" => "required",
            "purchase_place" => "required",
            "start_expired_date" => "required",
            "end_expired_date" => "required",
            // "description" => "required",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "business_address" => "alamat usaha",
            "purpose" => "tujuan usaha",
            "requirement" => "kebutuhan",
            "purchase_place" => "tempat pembelian",
            "start_expired_date" => "masa berlaku mulai",
            "end_expired_date" => "masa berlaku selesai",
            "description" => "deskripsi",
        ];
    }
}
