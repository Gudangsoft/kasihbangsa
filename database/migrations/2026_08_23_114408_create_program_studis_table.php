<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program_studis', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('jenjang')->nullable();
            $table->string('gelar')->nullable();
            $table->string('akreditasi')->nullable();
            $table->string('akreditasi_sk')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('visi')->nullable();
            $table->json('misi')->nullable();
            $table->json('tujuan')->nullable();
            $table->longText('kurikulum')->nullable();
            $table->longText('profil_lulusan')->nullable();
            $table->longText('fasilitas')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_studis');
    }
};
