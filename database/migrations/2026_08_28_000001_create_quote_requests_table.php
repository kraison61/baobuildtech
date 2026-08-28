<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();

            $table->string('name', 120);
            $table->string('phone', 30);
            // ค่าตรงกับ ContactContent::jobTypes() — structure, foundation, civil, ...
            $table->string('job_type', 32);
            $table->string('area', 160);
            $table->text('detail')->nullable();

            // pending = รอติดต่อ | contacted = ติดต่อแล้ว | quoted = ส่งใบเสนอราคาแล้ว | closed = ปิดเคส
            $table->string('status', 20)->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamp('contacted_at')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('job_type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
