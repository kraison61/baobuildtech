<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServicePriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return [
            'priceable_type' => ['required', Rule::in(['service', 'service_item'])],
            'priceable_id' => ['required', 'integer', 'min:1'],
            'price_type' => ['required', Rule::in(['unit', 'material', 'package', 'volume'])],
            'label' => ['required', 'string', 'max:255'],
            'price_min' => ['nullable', 'numeric', 'min:0'],
            'price_max' => ['nullable', 'numeric', 'min:0'],
            'price_unit' => ['nullable', 'string', 'max:80'],
            'currency' => ['nullable', 'string', 'size:3'],
            'note' => ['nullable', 'string', 'max:500'],
            'is_visible' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_visible' => $this->boolean('is_visible'),
            'sort_order' => $this->input('sort_order', 0),
            'currency' => $this->input('currency', 'THB'),
        ]);
    }
}
