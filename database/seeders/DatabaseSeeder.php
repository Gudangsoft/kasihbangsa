<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // $rows = User::where('username', null)->get();
        // foreach($rows as $row) {
        //     $user = User::findOrFail($row->id);
        //     $user->email_verified_at = Carbon::now();
        //     $user->save();

        //     $user->syncRoles(['guest']);
        // }

        $this->call([
            UserSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
            // MenuSeeder::class,
            CompanyProfileSeeder::class,
        ]);
    }
}
