<?php

namespace App\Http\Requests\Admin;

use App\Support\Coordinates;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'service_id' => ['nullable', 'exists:services,id'],
            'service_item_id' => ['nullable', 'exists:service_items,id'],
            'location_id' => ['nullable', 'exists:locations,id'],
            'coordinates' => ['nullable', 'string', 'max:100'],
            'lat' => ['nullable', 'numeric', 'between:-90,90'],
            'lng' => ['nullable', 'numeric', 'between:-180,180'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string', 'max:500'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'completed_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:100'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'is_published' => ['boolean'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'lat.between' => 'Latitude ต้องอยู่ระหว่าง -90 ถึง 90',
            'lng.between' => 'Longitude ต้องอยู่ระหว่าง -180 ถึง 180',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if (! $this->filled('coordinates')) {
                return;
            }

            if ($this->input('lat') === null || $this->input('lng') === null) {
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
            'service_id' => $this->input('service_id') ?: null,
            'service_item_id' => $this->input('service_item_id') ?: null,
            'location_id' => $this->input('location_id') ?: null,
            'lat' => $lat,
            'lng' => $lng,
        ]);
    }
}
