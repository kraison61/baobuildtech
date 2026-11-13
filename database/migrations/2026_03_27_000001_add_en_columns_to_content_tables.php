<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('headline_en', 255)->nullable()->after('headline');
            $table->text('description_en')->nullable()->after('description');
            $table->longText('content_en')->nullable()->after('content');
            $table->string('excerpt_en', 500)->nullable()->after('excerpt');
            $table->string('service_type_en', 120)->nullable()->after('service_type');
            $table->string('meta_title_en', 100)->nullable()->after('meta_title');
            $table->string('meta_description_en', 160)->nullable()->after('meta_description');
        });

        Schema::table('service_items', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('headline_en')->nullable()->after('headline');
            $table->text('description_en')->nullable()->after('description');
            $table->string('excerpt_en', 500)->nullable()->after('excerpt');
            $table->longText('content_en')->nullable()->after('content');
            $table->string('meta_title_en', 100)->nullable()->after('meta_title');
            $table->string('meta_description_en', 160)->nullable()->after('meta_description');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('excerpt_en')->nullable()->after('excerpt');
            $table->longText('body_en')->nullable()->after('body');
            $table->string('meta_title_en', 100)->nullable()->after('meta_title');
            $table->string('meta_description_en', 160)->nullable()->after('meta_description');
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->text('description_en')->nullable()->after('description');
            $table->string('client_name_en')->nullable()->after('client_name');
            $table->string('meta_title_en', 100)->nullable()->after('meta_title');
            $table->string('meta_description_en', 160)->nullable()->after('meta_description');
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->string('question_en', 500)->nullable()->after('question');
            $table->text('answer_en')->nullable()->after('answer');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('province_en', 120)->nullable()->after('province');
            $table->string('district_en', 120)->nullable()->after('district');
            $table->text('description_en')->nullable()->after('description');
            $table->string('meta_title_en', 100)->nullable()->after('meta_title');
            $table->string('meta_description_en', 160)->nullable()->after('meta_description');
        });

        Schema::table('service_prices', function (Blueprint $table) {
            $table->string('label_en')->nullable()->after('label');
            $table->string('price_unit_en', 80)->nullable()->after('price_unit');
            $table->string('note_en', 500)->nullable()->after('note');
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->text('bio_en')->nullable()->after('bio');
            $table->string('job_title_en', 120)->nullable()->after('job_title');
        });
    }

    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en']);
        });

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'name_en', 'headline_en', 'description_en', 'content_en',
                'excerpt_en', 'service_type_en', 'meta_title_en', 'meta_description_en',
            ]);
        });

        Schema::table('service_items', function (Blueprint $table) {
            $table->dropColumn([
                'name_en', 'headline_en', 'description_en', 'excerpt_en',
                'content_en', 'meta_title_en', 'meta_description_en',
            ]);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'title_en', 'excerpt_en', 'body_en', 'meta_title_en', 'meta_description_en',
            ]);
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn([
                'title_en', 'description_en', 'client_name_en', 'meta_title_en', 'meta_description_en',
            ]);
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->dropColumn(['question_en', 'answer_en']);
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn([
                'name_en', 'province_en', 'district_en', 'description_en',
                'meta_title_en', 'meta_description_en',
            ]);
        });

        Schema::table('service_prices', function (Blueprint $table) {
            $table->dropColumn(['label_en', 'price_unit_en', 'note_en']);
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn(['bio_en', 'job_title_en']);
        });
    }
};
