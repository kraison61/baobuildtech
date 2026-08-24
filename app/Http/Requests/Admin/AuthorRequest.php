<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'avatar' => ['nullable', 'string', 'max:500'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'social_links' => ['nullable', 'string'],
            'is_active' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $links = $this->input('social_links');
        $parsed = null;

        if (is_string($links) && trim($links) !== '') {
            $decoded = json_decode($links, true);
            $parsed = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
        }

        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'social_links' => $parsed,
        ]);
    }
}
