<?php

namespace App\Http\Requests\Admin;

use App\Models\QuoteRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuoteRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        $jobValues = array_column(\App\Support\ContactContent::jobTypes(), 'value');

        return [
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'job_type' => ['required', 'string', Rule::in($jobValues)],
            'area' => ['required', 'string', 'max:160'],
            'detail' => ['nullable', 'string', 'max:2000'],
            'status' => ['required', 'string', Rule::in(QuoteRequest::statuses())],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
            'contacted_at' => ['nullable', 'date'],
        ];
    }

    /** @return array<string, string> */
    public function attributes(): array
    {
        return [
            'name' => 'ชื่อผู้ติดต่อ',
            'phone' => 'เบอร์โทร',
            'job_type' => 'ประเภทงาน',
            'area' => 'ที่ตั้งหน้างาน',
            'detail' => 'รายละเอียดหน้างาน',
            'status' => 'สถานะ',
            'admin_notes' => 'บันทึกภายใน',
            'contacted_at' => 'วันที่ติดต่อกลับ',
        ];
    }
}
