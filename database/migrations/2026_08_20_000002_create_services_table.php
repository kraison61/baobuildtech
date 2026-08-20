<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                  ->constrained('service_categories')
                  ->restrictOnDelete();                  // FK → service_categories
            $table->string('name');                      // schema: Service.name
            $table->string('slug')->unique();            // ใช้ประกอบ @id / url
            $table->text('description')->nullable();     // schema: description (strip_tags)
            $table->string('excerpt', 500)->nullable();  // meta description
            $table->string('cover_image')->nullable();   // schema: image
            $table->string('service_type', 120)->nullable(); // schema: serviceType
            // ราคา: generate schema เฉพาะเมื่อมีแถวใน service_prices ที่ is_visible = true
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(false); // false = ไม่ generate schema
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index('slug');
            $table->index('category_id');
            $table->index(['is_published', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
