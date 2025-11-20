<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_name'    => ['sometimes', 'required', 'string', 'max:100'],
            'topic'          => ['sometimes', 'required', 'string', 'max:150'],
            'message'        => ['sometimes', 'nullable', 'string', 'max:500'],
            'preferred_time' => ['sometimes', 'nullable', 'string', 'max:100'],
        ];
    }
}
