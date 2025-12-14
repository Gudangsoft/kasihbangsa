<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->sentence,
                'slug' => Str::slug($faker->sentence),
                'preview' => $faker->text(150),
                'content' => $faker->paragraphs(5, true),
                'image' => $faker->imageUrl(640, 480, 'post', true),
                'publish_at' => $faker->dateTimeBetween('-1 year', 'now'),
                'category_id' => $faker->numberBetween(1, 10), // Assuming 10 categories exist
                'tags' => json_encode($faker->words(5)),
                'status' => $faker->boolean,
                'created_by' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
