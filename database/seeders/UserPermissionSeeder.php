<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userPermissions = [
            'view_user',
            'view_any_user',
            'create_user',
            'update_user',
            'delete_user',
            'restore_user',
            'force_delete_user',
        ];

        // Create Permissions
        foreach ($userPermissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Find or Create Super Admin User
        $superAdmin = User::firstOrCreate(
            ['email' => 'alex@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('cdaaptnia'),
            ]
        );

        // Assign Super Admin Role
        $superAdmin->assignRole('super_admin');

        // Optional: Assign Permissions to Super Admin directly
        $superAdmin->syncPermissions($userPermissions);
    }
}
