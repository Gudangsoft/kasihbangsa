<?php

namespace App\Filament\Resources\InformationResource\Pages;

use App\Filament\Resources\InformationCategoryResource;
use App\Filament\Resources\InformationResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListInformation extends ListRecords
{
    protected static string $resource = InformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah')
            ->icon('heroicon-o-plus-circle'),
            Action::make('Categories')
                ->color('warning')
                ->icon('heroicon-o-queue-list')
                ->url(fn(): string => InformationCategoryResource::getUrl('index'))
                ->visible(auth()->user()->isAdmin()),
        ];
    }
}
