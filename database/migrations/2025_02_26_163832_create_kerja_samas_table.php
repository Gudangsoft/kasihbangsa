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
    Schema::create('kerja_samas', function (Blueprint $table) {
        $table->id();
        $table->string('kode')->unique();
        $table->string('lembaga_mitra');
        $table->boolean('internasional')->default(false);
        $table->boolean('nasional')->default(false);
        $table->boolean('wilayah_lokal')->default(false);
        $table->string('judul_kerja_sama');
        $table->text('manfaat')->nullable();
        $table->string('dokumen')->nullable();
        $table->timestamp('start_date')->nullable();
        $table->timestamp('end_date')->nullable();
        $table->boolean('status')->default(false);
        $table->timestamps();
        $table->softDeletes();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerja_samas');
    }
};
