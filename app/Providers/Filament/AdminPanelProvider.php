<?php

namespace App\Providers\Filament;

use App\Filament\AvatarProviders\BoringAvatarsProvider;
use App\Filament\AvatarProviders\NoztAvatarsProvider;
use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Dashboard;
use App\Filament\Resources\UserResource\Widgets\UserOverview;
use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\AvatarProviders\UiAvatarsProvider;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\UserMenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->brandLogo(fn (): HtmlString => new HtmlString(
                '<div class="flex items-center gap-2">'
                .'<img src="'.e(company()->image).'" alt="'.e(company()->name).'" class="h-8 w-8 rounded-md object-cover flex-shrink-0" />'
                .'<span class="text-sm font-semibold leading-tight text-gray-950 dark:text-white">'.e(company()->name).'</span>'
                .'</div>'
            ))
            ->brandLogoHeight('2rem')
            ->brandName(company()->name)
            ->favicon(company()->image)
            ->defaultAvatarProvider(NoztAvatarsProvider::class)
            ->id('admin')
            ->path('admin')
            ->login(Login::class)
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth(MaxWidth::Full)
            ->navigationGroups([
                'Akademik',
                'Konten & Publikasi',
                'Media & Tampilan',
                'Layanan & Interaksi',
                'Management',
                'Pengaturan Website',
                'Pelindung',
                'Bantuan',
            ])
            ->colors([
                'primary' => Color::Emerald,
            ])
            ->userMenuItems([
                UserMenuItem::make()
                    ->label('Lihat Website')
                    ->url('/', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-globe-alt'),
                UserMenuItem::make()
                    ->label('Ganti Password')
                    ->url(fn (): string => route('filament.admin.pages.change-password'))
                    ->icon('heroicon-o-key'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
                // UserOverview::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
