<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->enum('type', ['live', 'recorded'])->default('live')->after('slug');
            $table->string('short_description')->nullable()->after('type');
            $table->string('duration')->nullable()->after('webinar_time');
            $table->string('platform')->nullable()->after('duration');
            $table->integer('quota')->nullable()->after('link');
            $table->enum('status', ['draft', 'scheduled', 'published'])->default('draft')->after('quota');
            $table->string('category')->nullable()->after('status');
            $table->string('tags')->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropColumn([
                'type', 'short_description', 'duration', 'platform',
                'quota', 'status', 'category', 'tags',
            ]);
        });
    }
};