<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->foreignId('author_id')->nullable()->after('category_id')->constrained('users')->nullOnDelete();
            $table->string('excerpt', 200)->nullable()->after('content');
            $table->boolean('featured')->default(false)->after('is_published');
        });
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropColumn(['author_id', 'excerpt', 'featured']);
        });
    }
};