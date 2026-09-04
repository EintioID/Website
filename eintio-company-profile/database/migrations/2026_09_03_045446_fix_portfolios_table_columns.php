<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->renameColumn('thumbnail', 'image');
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->string('client')->nullable()->after('category_id');
            $table->date('project_date')->nullable()->after('client');
        });

        DB::table('portfolios')->whereNull('slug')->orWhere('slug', '')->orderBy('id')->each(function ($row) {
            $slug = \Illuminate\Support\Str::slug($row->title) . '-' . $row->id;
            DB::table('portfolios')->where('id', $row->id)->update(['slug' => $slug]);
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable(false)->change();
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn('year');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->year('year')->nullable();
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'client', 'project_date']);
        });

        Schema::table('portfolios', function (Blueprint $table) {
            $table->renameColumn('image', 'thumbnail');
        });
    }
};