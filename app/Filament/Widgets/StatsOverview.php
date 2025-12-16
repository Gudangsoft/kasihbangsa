<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Information;
use App\Models\Gallery;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', Post::count())
                ->description('Artikel berita yang telah dibuat')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Total Informasi', Information::count())
                ->description('Informasi & Dokumen')
                ->descriptionIcon('heroicon-m-document')
                ->color('info')
                ->chart([3, 2, 5, 4, 3, 4, 5, 6]),

            Stat::make('Total Galeri', Gallery::count())
                ->description('Album foto tersedia')
                ->descriptionIcon('heroicon-m-photo')
                ->color('warning')
                ->chart([2, 4, 3, 5, 2, 3, 4, 3]),

            Stat::make('Total User', User::count())
                ->description('Pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([1, 2, 2, 3, 3, 4, 4, 5]),
        ];
    }
}
