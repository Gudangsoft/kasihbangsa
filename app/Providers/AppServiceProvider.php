<?php

namespace App\Providers;

use App\Models\CompanyProfile;
use App\Models\Menu;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use App\Policies\CompanyProfilePolicy;
use App\Policies\MenuPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\PostCategoryPolicy;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    ->label('Settings')
                    ->icon('heroicon-s-cog')
                    ->url(function () {
                        // Mendapatkan ID user yang sedang login
                        $userId = Auth::id();

                        // Redirect ke halaman edit user berdasarkan ID user
                        return route('filament.admin.resources.users.edit', $userId);
                    }),
            ]);
        });

        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Permission::class, PermissionPolicy::class);
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(PostCategory::class, PostCategoryPolicy::class);
        Gate::policy(Menu::class, MenuPolicy::class);
        Gate::policy(CompanyProfile::class, CompanyProfilePolicy::class);
    }
}
