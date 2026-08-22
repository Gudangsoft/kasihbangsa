<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('nidn')->nullable();
            $table->string('prodi')->nullable();
            $table->string('jabatan_akademik')->nullable();
            $table->string('jabatan_institusi')->nullable();
            $table->string('status_dosen')->nullable();
            $table->string('sertifikasi_dosen')->nullable();
            $table->json('riwayat_pendidikan')->nullable();
            $table->json('penelitian')->nullable();
            $table->json('pengabdian_masyarakat')->nullable();
            $table->json('capaian_khusus')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};
