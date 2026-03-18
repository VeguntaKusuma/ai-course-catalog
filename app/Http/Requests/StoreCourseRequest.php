<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'instructor' => ['required', 'regex:/^[A-Za-z\s]+$/'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'regex:/^[A-Za-z0-9\s\.,]+$/'],

            // ✅ NEW FIELD
            'duration' => ['required', 'regex:/^[0-9]+\s?[A-Za-z]+$/'],

            'image' => ['nullable', 'mimes:jpg,jpeg,png'],
        ];
    }

    public function messages(): array
{
    return [
        'duration.regex' => 'Duration must be like "3 Months" or "12 Weeks".',
    ];
}
}