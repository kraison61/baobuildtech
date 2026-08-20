<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')
                  ->constrained('portfolios')
                  ->cascadeOnDelete();                   // ลบผลงาน = ลบรูปทั้งหมด

            $table->string('image_url');                 // schema: ImageObject.url (absolute)
            $table->string('alt_text')->nullable();      // accessibility + SEO
            // schema: ImageObject.width / height — Google ใช้ตรวจสอบขนาด
            // บันทึกตอน upload รูป (getimagesize หรือ Intervention Image)
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->smallInteger('sort_order')->default(0);
            // ไม่มี timestamps — รูปไม่มี lifecycle แยกจาก portfolio

            $table->index(['portfolio_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_images');
    }
};
