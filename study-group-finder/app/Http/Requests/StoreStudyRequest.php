<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'course_name'    => ['required', 'string', 'max:100'],
            'topic'          => ['required', 'string', 'max:150'],
            'message'        => ['nullable', 'string', 'max:500'],
            'preferred_time' => ['nullable', 'string', 'max:100'],
        ];
    }
}
