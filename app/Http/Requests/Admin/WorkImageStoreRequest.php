<?php

namespace App\Http\Requests\Admin;

use App\Support\Coordinates;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class WorkImageStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'portfolio_id' => ['nullable', 'exists:portfolios,id'],
            'service_item_id' => ['nullable', 'exists:service_items,id'],
            'coordinates' => ['nullable', 'string', 'max:100'],
            'lat' => ['nullable', 'numeric', 'between:-90,90'],
            'lng' => ['nullable', 'numeric', 'between:-180,180'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['boolean'],
            'images' => ['required', 'array', 'min:1', 'max:30'],
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'images.required' => 'กรุณาเลือกไฟล์รูปภาพอย่างน้อย 1 ไฟล์',
            'images.max' => 'อัปโหลดได้สูงสุด 30 ไฟล์ต่อครั้ง',
            'images.*.image' => 'ไฟล์ต้องเป็นรูปภาพเท่านั้น',
            'images.*.mimes' => 'รองรับเฉพาะ jpg, jpeg, png, webp',
            'images.*.max' => 'แต่ละไฟล์ต้องไม่เกิน 3 MB',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if (! $this->filled('portfolio_id') && ! $this->filled('service_item_id')) {
                $validator->errors()->add(
                    'portfolio_id',
                    'ต้องเลือกหน้างาน หรือรายการบริการอย่างน้อยหนึ่งอย่าง',
                );
            }

            if ($this->filled('coordinates') && ($this->input('lat') === null || $this->input('lng') === null)) {
                $validator->errors()->add(
                    'coordinates',
                    'พิกัดต้องเป็นรูปแบบ lat, lng เช่น 13.748436414898316, 100.48145963665914',
                );
            }
        });
    }

    protected function prepareForValidation(): void
    {
        [$lat, $lng] = Coordinates::parse($this->input('coordinates'));

        $this->merge([
            'is_published' => $this->boolean('is_published'),
            'portfolio_id' => $this->input('portfolio_id') ?: null,
            'service_item_id' => $this->input('service_item_id') ?: null,
            'sort_order' => $this->filled('sort_order') ? (int) $this->input('sort_order') : 0,
            'lat' => $lat,
            'lng' => $lng,
        ]);
    }
}
