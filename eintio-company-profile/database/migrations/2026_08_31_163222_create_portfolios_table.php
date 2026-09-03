<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable(); // ringkasan singkat di index
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->year('year')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->string('thumbnail')->nullable();
            $table->longText('background')->nullable(); // Latar Belakang Proyek
            $table->json('requirements')->nullable();   // Kebutuhan Proyek: ["...", "..."]
            $table->json('solutions')->nullable();       // Solusi: [{icon,title,description}]
            $table->json('gallery')->nullable();          // Galeri: ["path1","path2"]
            $table->integer('order')->nullable()->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};