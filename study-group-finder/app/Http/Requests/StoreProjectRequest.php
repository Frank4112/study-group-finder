<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'project_title' => 'required|string',
            'description' => 'required|string',
            'required_skills' => 'required|string',
            'difficulty_level' => 'required|string'
        ];
    }
}
