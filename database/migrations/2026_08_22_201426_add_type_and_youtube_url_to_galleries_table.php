<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->enum('type', ['photo', 'video'])->default('photo')->after('category_id');
            $table->string('youtube_url')->nullable()->after('image_path');
        });

        // Video galleries don't need a cover upload; drop the NOT NULL constraint.
        DB::statement('ALTER TABLE galleries MODIFY image_path VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['type', 'youtube_url']);
        });
    }
};
