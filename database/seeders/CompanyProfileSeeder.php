<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

            CompanyProfile::create([
                'name' => $faker->company,
                'description' => $faker->paragraph,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'website' => $faker->url,
                'logo' => '/storage/logo/' . $faker->word . '.png',
                'meta_title' => $faker->sentence(6),
                'meta_keywords' => implode(', ', $faker->words(5)),
                'meta_description' => $faker->paragraph,
            ]);
    }
}
