<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryCategoryResource;
use App\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('Categories')
                ->label('Kategori')
                ->color('warning')
                ->icon('heroicon-o-queue-list')
                ->url(fn(): string => GalleryCategoryResource::getUrl('index'))
                ->visible(auth()->user()->isAdmin()),
        ];
    }
}
