<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use App\Models\Menu;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(Menu::count()),
            'header' => Tab::make('Header')
                ->modifyQueryUsing(fn ($query) => $query->where('category', 'home'))
                ->badge(Menu::where('category', 'home')->count()),
            'footer' => Tab::make('Footer')
                ->modifyQueryUsing(fn ($query) => $query->where('category', 'footer'))
                ->badge(Menu::where('category', 'footer')->count()),
        ];
    }
}
