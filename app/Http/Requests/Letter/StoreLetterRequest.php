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
            "citizent_id" => ["required"],
            "letter_file" => "required|file|max:5000|mimes:pdf,doc,docs,docx" // accepted_file : pdf, doc, docs, docx
        ];
    }

    public function attributes()
    {
        return [
            'letter_file' => 'file surat',
        ];
    }
}
