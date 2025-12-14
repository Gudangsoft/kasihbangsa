<?php

namespace App\Filament\Pages;

use App\Filament\Resources\UserResource\Widgets\UserOverview;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Contracts\HasDashboard;
use Filament\Facades\Filament;
use Filament\Widgets\AccountWidget;
use Filament\Pages\Page;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-vertical';
    protected static ?int $navigationSort = 2;

    // protected static string $view = 'filament.pages.dashboard';

    public static function getNavigationLabel(): string
    {
        return 'Dashboard';
    }

    public function getWidgets(): array
    {
        return [
            AccountWidget::class,
            // UserOverview::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 1;
    }

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-home';
    }

}
