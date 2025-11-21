<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['sometimes', 'required', 'string', 'max:100'],
            'description'  => ['sometimes', 'required', 'string', 'min:10'],
            'location'     => ['sometimes', 'nullable', 'string', 'max:100'],
            'meeting_time' => ['sometimes', 'nullable', 'string', 'max:100'],
            'max_members'  => ['sometimes', 'nullable', 'integer', 'min:1'],
            'skills'       => ['sometimes', 'array'],
            'skills.*'     => ['integer', 'exists:skills,id'],
        ];
    }
}
