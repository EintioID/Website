<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'language')) {
                $table->string('language')->default('id')->after('email');
            }
            if (!Schema::hasColumn('users', 'theme')) {
                $table->string('theme')->default('light')->after('language');
            }
            if (!Schema::hasColumn('users', 'notify_enabled')) {
                $table->boolean('notify_enabled')->default(true)->after('theme');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['language', 'theme', 'notify_enabled']);
        });
    }
};