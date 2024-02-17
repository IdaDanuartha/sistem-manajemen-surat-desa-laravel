<?php

namespace App\Http\Requests\Letter\RegistrationForm;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationFormRequest extends FormRequest
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
            "time_period" => "required",
            "reason" => "required",
            "kaling_number" => "nullable",
            "bourding_house_owner" => "nullable",
            "address" => "nullable",
            "phone_number" => "nullable",
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "time_period" => "jangka waktu",
            "reason" => "alasan",
        ];
    }
}
