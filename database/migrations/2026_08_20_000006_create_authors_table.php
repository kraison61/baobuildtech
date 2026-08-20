<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');                      // schema: Person.name
            $table->string('slug')->unique();            // URL: /author/{slug}/
            $table->text('bio')->nullable();             // schema: description
            $table->string('avatar')->nullable();        // schema: image (absolute URL)
            $table->string('job_title', 120)->nullable(); // schema: jobTitle
            // schema: sameAs[] — {"linkedin":"...","facebook":"...","twitter":"..."}
            $table->json('social_links')->nullable();
            // หน้า /author/{slug}/ ต้องเข้าถึงได้จริง (E-E-A-T)
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
