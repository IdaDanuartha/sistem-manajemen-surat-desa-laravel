<?php

namespace App\Http\Requests\Letter\SkTraveling;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkTravelingRequest extends FormRequest
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
            "sk.cover_letter_number" => "required",
            "sk.is_published" => "nullable",  
            "travel_destination" => "required",            
            "purpose" => "nullable",            
        ];
    }

    public function attributes()
    {
        return [
            "sk.reference_number" => "nomor surat",
            "sk.cover_letter_number" => "nomor SP kaling",
            "travel_destination" => "tempat dituju",
            "purpose" => "keperluan surat",
        ];
    }
}
