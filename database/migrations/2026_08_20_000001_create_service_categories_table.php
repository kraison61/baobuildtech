<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');                      // schema: Service.name
            $table->string('slug')->unique();            // ใช้ประกอบ @id / url
            $table->text('description')->nullable();     // schema: description
            $table->string('cover_image')->nullable();   // schema: image
            $table->smallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true); // false = ไม่ generate schema
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_categories');
    }
};
