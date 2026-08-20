<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // schema: LocalBusiness.name + พื้นที่
            $table->string('slug')->unique();
            $table->string('province', 120);                 // schema: areaServed
            $table->string('district', 120)->nullable();
            $table->text('description')->nullable();         // schema: description

            // Override จาก company.php เฉพาะพื้นที่ที่มีสำนักงานย่อย
            // null = ใช้ค่าจาก company.php แทน (fallback)
            $table->string('phone', 20)->nullable();         // schema: telephone
            $table->string('street')->nullable();            // schema: streetAddress
            $table->char('postal_code', 5)->nullable();      // schema: postalCode

            // Geo เฉพาะพื้นที่ (override company.php)
            $table->decimal('lat', 10, 8)->nullable();       // schema: geo.latitude
            $table->decimal('lng', 11, 8)->nullable();       // schema: geo.longitude

            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();

            $table->index('slug');
            $table->index('province');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
