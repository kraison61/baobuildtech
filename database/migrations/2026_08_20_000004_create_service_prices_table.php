<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_prices', function (Blueprint $table) {
            $table->id();

            // Polymorphic: รองรับทั้ง services และ service_items
            $table->string('priceable_type', 64);        // 'service' | 'service_item'
            $table->unsignedBigInteger('priceable_id');

            // ประเภทราคา — กำหนด logic การแสดงผลและ schema type
            $table->enum('price_type', [
                'unit',      // ต่อหน่วย: 500 บ./ตร.ม.
                'material',  // ตามวัสดุ: รั้วเหล็ก = 1,200 บ.
                'package',   // แพ็กเกจ: Basic / Standard / Premium
                'volume',    // ปริมาณงาน: งานเล็ก / กลาง / ใหญ่
            ]);

            $table->string('label');                     // schema: Offer.name
            // schema: UnitPriceSpecification
            $table->decimal('price_min', 12, 2)->nullable(); // minPrice (number)
            $table->decimal('price_max', 12, 2)->nullable(); // maxPrice (null = ราคาเดียว)
            $table->string('price_unit', 80)->nullable();    // unitText เช่น "บาท/ตร.ม."
            $table->char('currency', 3)->default('THB');     // priceCurrency

            $table->string('note', 500)->nullable();     // หมายเหตุ (แสดงบนหน้า)
            // is_visible = false → ไม่ generate schema (ต้องตรงกับสิ่งที่แสดงบนหน้า)
            $table->boolean('is_visible')->default(true);
            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['priceable_type', 'priceable_id', 'is_visible', 'sort_order'],
                          'idx_service_prices_priceable');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_prices');
    }
};
