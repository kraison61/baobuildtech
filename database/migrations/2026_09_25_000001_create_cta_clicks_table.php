<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cta_clicks', function (Blueprint $table) {
            $table->id();

            // line = กดแอด/ทักไลน์ | phone = กดโทร
            $table->string('channel', 16);
            // จุดกด เช่น header, cta-section, home-hero
            $table->string('source', 64);
            $table->string('page_url', 500)->nullable();
            $table->string('referrer', 500)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->string('ip', 45)->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->index('channel');
            $table->index('source');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cta_clicks');
    }
};
