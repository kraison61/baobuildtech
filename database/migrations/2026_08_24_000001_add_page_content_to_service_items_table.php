<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->string('headline')->nullable()->after('description');
            $table->string('excerpt', 500)->nullable()->after('headline');
            $table->longText('content')->nullable()->after('excerpt');
            $table->timestamp('published_at')->nullable()->after('is_published');

            $table->index(['is_published', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            $table->dropIndex(['is_published', 'published_at']);
            $table->dropColumn(['headline', 'excerpt', 'content', 'published_at']);
        });
    }
};
