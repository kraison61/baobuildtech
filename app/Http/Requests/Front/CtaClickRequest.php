<?php

namespace App\Http\Requests\Front;

use App\Models\CtaClick;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CtaClickRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'channel' => ['required', 'string', Rule::in(CtaClick::channels())],
            'source' => ['required', 'string', 'max:64'],
            'page_url' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'channel' => 'ช่องทาง',
            'source' => 'จุดกด',
            'page_url' => 'หน้าเว็บ',
        ];
    }
}
