<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string'],
            'required_skills' => ['nullable', 'string', 'max:255'],
            'status'          => ['required', 'in:open,closed'],
            'max_members'     => ['nullable', 'integer', 'min:1'],
            'location'        => ['nullable', 'string', 'max:255'],
            'meeting_time'    => ['nullable', 'date_format:H:i'],
        ];
    }
}
