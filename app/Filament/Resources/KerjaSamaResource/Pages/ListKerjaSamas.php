<?php

namespace App\Filament\Resources\KerjaSamaResource\Pages;

use App\Filament\Resources\KerjaSamaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKerjaSamas extends ListRecords
{
    protected static string $resource = KerjaSamaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah')
            ->icon('heroicon-o-plus-circle'),
        ];
    }
}
