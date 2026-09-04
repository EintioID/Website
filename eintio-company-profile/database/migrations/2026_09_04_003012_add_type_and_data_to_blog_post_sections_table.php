<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_post_sections', function (Blueprint $table) {
            $table->string('type')->default('description')->after('blog_post_id');
            $table->string('badge')->nullable()->after('type');
            $table->json('data')->nullable()->after('content');
        });

        \DB::table('blog_post_sections')->whereNull('data')->orderBy('id')->each(function ($row) {
            \DB::table('blog_post_sections')->where('id', $row->id)->update([
                'type' => 'description',
                'data' => json_encode(['description' => $row->content]),
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('blog_post_sections', function (Blueprint $table) {
            $table->dropColumn(['type', 'badge', 'data']);
        });
    }
};