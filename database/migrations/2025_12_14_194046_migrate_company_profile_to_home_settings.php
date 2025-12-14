<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Copy data dari company_profiles ke home_settings jika ada
        if (Schema::hasTable('company_profiles')) {
            $companyProfile = DB::table('company_profiles')->first();

            if ($companyProfile && DB::table('home_settings')->count() === 0) {
                DB::table('home_settings')->insert([
                    'company_name' => $companyProfile->name ?? 'STP Dian Mandala',
                    'company_description' => $companyProfile->description ?? null,
                    'company_address' => $companyProfile->address ?? null,
                    'company_phone' => $companyProfile->phone ?? null,
                    'company_email' => $companyProfile->email ?? null,
                    'company_website' => $companyProfile->website ?? null,
                    'company_logo' => $companyProfile->logo ?? null,
                    'meta_title' => $companyProfile->meta_title ?? null,
                    'meta_keywords' => $companyProfile->meta_keywords ?? null,
                    'meta_description' => $companyProfile->meta_description ?? null,
                    'facebook' => $companyProfile->fb ?? null,
                    'instagram' => $companyProfile->ig ?? null,
                    'youtube' => $companyProfile->youtube ?? null,
                    'twitter' => $companyProfile->twitter ?? null,
                    'tiktok' => $companyProfile->tiktok ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu rollback karena ini adalah migrasi data satu arah
    }
};
