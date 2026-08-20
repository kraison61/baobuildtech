<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')
                  ->constrained('authors')
                  ->restrictOnDelete();

            $table->string('title');                     // schema: headline (ต้องตรงกับ H1)
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();         // schema: description
            $table->longText('body');                    // เนื้อหาที่แสดงบนหน้า

            // 3 ratio สำหรับ rich result — Google ดึง array image[]
            // ขนาดขั้นต่ำ: กว้าง ≥ 1200px
            $table->string('image_16x9')->nullable();    // schema: image[0]
            $table->string('image_4x3')->nullable();     // schema: image[1]
            $table->string('image_1x1')->nullable();     // schema: image[2]

            // schema: datePublished / dateModified (ISO 8601 + TZ)
            // updated_at = dateModified — ห้าม touch มั่ว
            $table->timestamp('published_at')->nullable();

            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 160)->nullable();
            // คำนวณจาก strip_tags(body) ตอน saving event
            $table->unsignedSmallInteger('word_count')->nullable(); // schema: wordCount
            $table->boolean('is_published')->default(false);
            $table->timestamps(); // updated_at → schema: dateModified

            $table->index('slug');
            $table->index('author_id');
            $table->index(['is_published', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
