<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('webinar_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('webinar_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('whatsapp')->nullable();
            $table->string('institution')->nullable();
            $table->string('occupation')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['registered', 'attended', 'cancelled'])->default('registered');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('webinar_participants');
    }
};