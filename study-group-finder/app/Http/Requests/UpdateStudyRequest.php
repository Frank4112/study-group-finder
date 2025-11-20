<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudyRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'subject' => 'required|string',
            'course' => 'required|string',
            'level' => 'required|string',
            'description' => 'nullable|string'
        ];
    }
}
