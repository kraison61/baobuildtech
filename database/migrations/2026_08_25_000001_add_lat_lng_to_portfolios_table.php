<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->decimal('lat', 10, 8)->nullable()->after('location_id'); // schema: geo.latitude
            $table->decimal('lng', 11, 8)->nullable()->after('lat');        // schema: geo.longitude
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['lat', 'lng']);
        });
    }
};
