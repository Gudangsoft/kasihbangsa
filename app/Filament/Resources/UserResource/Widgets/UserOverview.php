<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Support\Facades\DB;

class UserOverview extends StatsOverviewWidget
{
    // protected static ?string $heading = 'Chart';

    protected function getCards(): array
    {
        return [
            Card::make('Total Users', User::count())
                ->chart($this->getUserGrowthChart())
                ->description('Pertumbuhan user 6 bulan terakhir')
                ->icon('heroicon-o-users'),

            Card::make('User by Role', $this->getUserByRoleString())
                ->description('Komposisi user berdasarkan role')
                ->color('primary')
                ->icon('heroicon-o-user'),

            // Card::make('Average Age',
            //     number_format(User::avg('age'), 1) . ' Tahun'
            // )
            //     ->description('Rata-rata umur user')
            //     ->color('success')
            //     ->icon('heroicon-o-calendar'),

            Card::make('User Registration',
                User::whereMonth('created_at', now()->month)->count()
            )
                ->description('User baru bulan ini')
                ->color('warning')
                ->icon('heroicon-o-user-plus')
        ];
    }

    protected function getUserGrowthChart(): array
    {
        $userGrowth = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count')
        ->toArray();

        return $userGrowth;
    }

    protected function getUserByRoleString(): string
    {
        $roleCount = User::with('roles')
            ->get()
            ->groupBy('roles.0.name')
            ->map(function ($users) {
                return $users->count();
            });

        return $roleCount->map(function ($count, $role) {
            return "$role: $count";
        })->implode(' | ');
    }
}
