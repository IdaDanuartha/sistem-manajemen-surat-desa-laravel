<?php

namespace App\Http\Requests\Letter\SkLandPrice;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkLandPriceRequest extends FormRequest
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
            "nop" => "required",
            "land_location" => "required",
            "price" => "required",
            "purpose" => "required"
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "nop" => "nomor objek pajak",
            "land_location" => "lokasi tanah",
            "price" => "harga",
            "purpose" => "keperluan surat"
        ];
    }
}
