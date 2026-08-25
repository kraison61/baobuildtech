<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
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
        $jobValues = array_column(\App\Support\ContactContent::jobTypes(), 'value');

        return [
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'job' => ['required', 'string', Rule::in($jobValues)],
            'area' => ['required', 'string', 'max:160'],
            'detail' => ['nullable', 'string', 'max:2000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'ชื่อผู้ติดต่อ',
            'phone' => 'เบอร์โทร',
            'job' => 'ประเภทงาน',
            'area' => 'ที่ตั้งหน้างาน',
            'detail' => 'รายละเอียดหน้างาน',
        ];
    }
}
