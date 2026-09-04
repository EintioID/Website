<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            if (!Schema::hasColumn('teams', 'order')) {
                $table->integer('order')->nullable()->default(0)->after('bio');
            }
            if (!Schema::hasColumn('teams', 'linkedin')) {
                $table->string('linkedin')->nullable()->after('order');
            }
            if (!Schema::hasColumn('teams', 'instagram')) {
                $table->string('instagram')->nullable()->after('linkedin');
            }
            if (!Schema::hasColumn('teams', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('instagram');
            }
            if (!Schema::hasColumn('teams', 'photo')) {
                $table->string('photo')->nullable()->after('is_active');
            }
        });
    }

    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn(['order', 'linkedin', 'instagram', 'is_active', 'photo']);
        });
    }
};