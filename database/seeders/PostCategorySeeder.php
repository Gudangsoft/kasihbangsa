<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Health',
            'Lifestyle',
            'Education',
            'Travel',
            'Food',
            'Finance',
            'Entertainment',
            'Sports',
            'News'
        ];

        foreach ($categories as $category) {
            DB::table('post_categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category),
                'description' => "Category about $category",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
