<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('work_images', function (Blueprint $table) {
            $table->id();

            // หน้างาน (ผลงาน)
            $table->foreignId('portfolio_id')
                ->nullable()
                ->constrained('portfolios')
                ->nullOnDelete();

            // เกี่ยวข้องกับรายการบริการ
            $table->foreignId('service_item_id')
                ->nullable()
                ->constrained('service_items')
                ->nullOnDelete();

            $table->string('path');                       // path บน disk public
            $table->string('original_name')->nullable();
            $table->string('mime_type', 100)->nullable();
            $table->unsignedInteger('size_bytes')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->decimal('lat', 10, 8)->nullable();    // schema: geo.latitude
            $table->decimal('lng', 11, 8)->nullable();    // schema: geo.longitude
            $table->smallInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->index(['portfolio_id', 'sort_order']);
            $table->index(['service_item_id', 'sort_order']);
            $table->index('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_images');
    }
};
