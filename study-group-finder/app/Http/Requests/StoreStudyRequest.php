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
            'subject'        => 'required|string|max:255',
            'course'         => 'required|string|max:255',

            // Updated levels
            'level'          => 'required|in:first_year,second_year,third_year,fourth_year',

            'description'    => 'nullable|string',
            'location'       => 'nullable|string|max:255',
            'preferred_time' => 'nullable|date',
        ];
    }
}
