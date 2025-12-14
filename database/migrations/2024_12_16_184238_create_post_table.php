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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Judul post
            $table->string('slug')->unique(); // Slug untuk URL
            $table->string('preview')->nullable(); // Preview singkat atau kutipan
            $table->text('content'); // Konten utama
            $table->string('image')->nullable(); // Path untuk gambar
            $table->timestamp('publish_at')->nullable(); // Waktu publikasi
            $table->foreignId('category_id')->constrained('post_categories')->onDelete('cascade'); // Relasi ke tabel kategori
            $table->json('tags')->nullable(); // Tags dalam format JSON
            $table->boolean('status')->default(false); // Status (published atau draft)
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Relasi ke user yang membuat
            $table->timestamps(); // created_at dan updated_at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
