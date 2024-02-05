<?php

namespace App\Http\Requests\Letter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLetterRequest extends FormRequest
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
            "citizent_id" => "required",
            "reference_number" => "required",
            "attachment" => "required",
            "regarding" => "required",
            "dear" => "required",
            "message" => "required",
            "copy_submitted" => "required",
            "invitation_attachment" => "required",
            "is_published" => "nullable",
            // "letter_file" => "required|file|max:5000|mimes:pdf,doc,docs,docx" // accepted_file : pdf, doc, docs, docx
        ];
    }

    public function attributes()
    {
        return [
            // 'letter_file' => 'file surat',
            "reference_number" => "nomor surat",
            "attachment" => "lampiran",
            "regarding" => "perihal",
            "dear" => "yth",
            "message" => "isi surat",
            "copy_submitted" => "tembusan disampaikan",
            "invitation_attachment" => "lampiran surat undangan",
        ];
    }
}
