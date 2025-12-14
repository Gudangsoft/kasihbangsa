<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('gallery_categories', function (Blueprint $table) {
            // Drop unique constraint dari 'name' dan 'slug'
            $table->dropUnique(['name']);
            $table->dropUnique(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gallery_categories', function (Blueprint $table) {
            // Tambahkan kembali unique constraint jika rollback
            $table->unique('name');
            $table->unique('slug');
        });
    }
};
