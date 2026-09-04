<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('tagline')->nullable()->after('company_name');
            $table->string('favicon')->nullable()->after('logo');

            $table->string('hero_badge')->nullable()->after('email');
            $table->string('hero_title')->nullable()->after('hero_badge');
            $table->text('hero_subtitle')->nullable()->after('hero_title');
            $table->string('hero_image')->nullable()->after('hero_subtitle');

            $table->string('cta_1_label')->nullable()->after('hero_image');
            $table->string('cta_1_url')->nullable()->after('cta_1_label');
            $table->string('cta_2_label')->nullable()->after('cta_1_url');
            $table->string('cta_2_url')->nullable()->after('cta_2_label');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'tagline', 'favicon',
                'hero_badge', 'hero_title', 'hero_subtitle', 'hero_image',
                'cta_1_label', 'cta_1_url', 'cta_2_label', 'cta_2_url',
            ]);
        });
    }
};