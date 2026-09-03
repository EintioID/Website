<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolios', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('draft')->after('description');
            }
            if (!Schema::hasColumn('portfolios', 'background')) {
                $table->longText('background')->nullable()->after('status');
            }
            if (!Schema::hasColumn('portfolios', 'requirements')) {
                $table->json('requirements')->nullable()->after('background');
            }
            if (!Schema::hasColumn('portfolios', 'solutions')) {
                $table->json('solutions')->nullable()->after('requirements');
            }
            if (!Schema::hasColumn('portfolios', 'gallery')) {
                $table->json('gallery')->nullable()->after('solutions');
            }
            if (!Schema::hasColumn('portfolios', 'order')) {
                $table->integer('order')->nullable()->default(0)->after('gallery');
            }
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['status', 'background', 'requirements', 'solutions', 'gallery', 'order']);
        });
    }
};