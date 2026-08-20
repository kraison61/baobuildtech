<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();

            // เชื่อมกับบริการ (nullable — ผลงานบางชิ้นอาจไม่ระบุบริการ)
            $table->foreignId('service_id')
                  ->nullable()
                  ->constrained('services')
                  ->nullOnDelete();                       // schema: about → Service @id

            $table->foreignId('service_item_id')
                  ->nullable()
                  ->constrained('service_items')
                  ->nullOnDelete();                       // ละเอียดขึ้น: ระบุบริการย่อย

            // เชื่อมกับพื้นที่ (nullable)
            $table->foreignId('location_id')
                  ->nullable()
                  ->constrained('locations')
                  ->nullOnDelete();                       // schema: locationCreated

            $table->string('title');                     // schema: CreativeWork.name
            $table->string('slug')->unique();
            $table->text('description')->nullable();     // schema: description
            $table->string('cover_image')->nullable();   // schema: image (รูปหลัก)
            $table->string('client_name')->nullable();   // แสดงบนหน้า (ถ้าลูกค้ายินยอม)
            $table->date('completed_at')->nullable();    // schema: dateCreated
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->index('slug');
            $table->index('service_id');
            $table->index('location_id');
            $table->index('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
