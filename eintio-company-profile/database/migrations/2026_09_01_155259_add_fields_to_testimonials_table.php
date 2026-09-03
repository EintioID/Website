<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Rename kolom message -> testimoni (syntax MariaDB: CHANGE nama_lama nama_baru tipe_data)
        DB::statement('ALTER TABLE testimonials CHANGE message testimoni TEXT NULL');

        // 2. Tambah kolom baru
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('client_institution')->nullable()->after('client_name');
            $table->string('category')->nullable()->after('testimoni');
            $table->string('status', 20)->default('pending')->after('category');
            $table->timestamp('submitted_at')->nullable()->after('status');
        });

        // 3. Backfill data lama (kalau sudah ada isinya)
        DB::table('testimonials')->update([
            'submitted_at' => DB::raw('created_at'),
            'status' => DB::raw("CASE WHEN is_published = 1 THEN 'approved' ELSE 'pending' END"),
        ]);

        // 4. Hapus kolom yang tidak dipakai lagi
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['is_published', 'client_photo']);
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->boolean('is_published')->default(true);
            $table->string('client_photo')->nullable();
        });

        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['client_institution', 'category', 'status', 'submitted_at']);
        });

        DB::statement('ALTER TABLE testimonials CHANGE testimoni message TEXT NULL');
    }
};