<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();

            // Polymorphic — ใช้ได้กับทุกหน้า
            $table->string('faqable_type', 64);
            // ค่าที่รองรับ:
            // 'service_category' | 'service' | 'service_item'
            // 'post' | 'location' | 'portfolio'
            $table->unsignedBigInteger('faqable_id');

            // schema: Question.name + acceptedAnswer.text
            // ต้องตรงกับ FAQ ที่แสดงบนหน้าทุกตัวอักษร
            $table->string('question', 500);             // schema: Question.name
            $table->text('answer');                      // schema: acceptedAnswer.text (strip_tags)

            $table->smallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true); // false = ไม่ generate schema

            $table->timestamp('created_at')->useCurrent();

            $table->index(
                ['faqable_type', 'faqable_id', 'is_active', 'sort_order'],
                'idx_faqs_faqable'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
