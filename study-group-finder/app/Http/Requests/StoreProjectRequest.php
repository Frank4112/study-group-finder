<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        // allow for now – RBAC in Task 3
        return true;
    }

    public function rules(): array
    {
        return [
            'title'        => ['required', 'string', 'max:100'],
            'description'  => ['required', 'string', 'min:10'],
            'location'     => ['nullable', 'string', 'max:100'],
            'meeting_time' => ['nullable', 'string', 'max:100'], // or 'date' if using real date
            'max_members'  => ['nullable', 'integer', 'min:1'],

            // if the form submits skills checkboxes: name="skills[]"
            'skills'       => ['nullable', 'array'],
            'skills.*'     => ['integer', 'exists:skills,id'],
        ];
    }
}
