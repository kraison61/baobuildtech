<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'author_id' => ['required', 'exists:authors,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['nullable', 'string'],
            'image_16x9_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'image_4x3_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'image_1x1_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'remove_image_16x9' => ['boolean'],
            'remove_image_4x3' => ['boolean'],
            'remove_image_1x1' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:100'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'is_published' => ['boolean'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'image_16x9_file.image' => 'ไฟล์ต้องเป็นรูปภาพเท่านั้น',
            'image_16x9_file.mimes' => 'รองรับเฉพาะ jpg, jpeg, png, webp',
            'image_16x9_file.max' => 'ไฟล์ต้องไม่เกิน 3 MB',
            'image_4x3_file.image' => 'ไฟล์ต้องเป็นรูปภาพเท่านั้น',
            'image_4x3_file.mimes' => 'รองรับเฉพาะ jpg, jpeg, png, webp',
            'image_4x3_file.max' => 'ไฟล์ต้องไม่เกิน 3 MB',
            'image_1x1_file.image' => 'ไฟล์ต้องเป็นรูปภาพเท่านั้น',
            'image_1x1_file.mimes' => 'รองรับเฉพาะ jpg, jpeg, png, webp',
            'image_1x1_file.max' => 'ไฟล์ต้องไม่เกิน 3 MB',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'remove_image_16x9' => $this->boolean('remove_image_16x9'),
            'remove_image_4x3' => $this->boolean('remove_image_4x3'),
            'remove_image_1x1' => $this->boolean('remove_image_1x1'),
        ]);
    }
}
