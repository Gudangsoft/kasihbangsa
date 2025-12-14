<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_settings', function (Blueprint $table) {
            $table->id();

            // About Section
            $table->string('about_title')->nullable();
            $table->string('about_subtitle')->nullable();
            $table->text('about_description')->nullable();
            $table->string('about_image')->nullable();
            $table->string('about_video_url')->nullable();

            // Stats Section
            $table->integer('stat_programs')->default(5);
            $table->string('stat_programs_label')->default('Program Studi');
            $table->integer('stat_students')->default(500);
            $table->string('stat_students_label')->default('Mahasiswa Aktif');
            $table->integer('stat_lecturers')->default(50);
            $table->string('stat_lecturers_label')->default('Dosen Profesional');
            $table->string('stat_accreditation')->default('A');
            $table->string('stat_accreditation_label')->default('Akreditasi');

            // Contact Section
            $table->string('contact_title')->default('Kotak Layanan STP Dian Mandala');
            $table->string('contact_subtitle')->nullable();
            $table->text('contact_description')->nullable();
            $table->text('map_embed_url')->nullable();

            // Footer
            $table->text('footer_description')->nullable();
            $table->string('footer_copyright')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_settings');
    }
};
