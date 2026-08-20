<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')
                  ->constrained('services')
                  ->restrictOnDelete();                  // FK → services
            $table->string('name');                      // schema: Service.name (ย่อย)
            $table->string('slug')->unique();            // ใช้ประกอบ @id / url
            $table->text('description')->nullable();     // schema: description
            $table->string('cover_image')->nullable();   // schema: image
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->index('slug');
            $table->index('service_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_items');
    }
};
