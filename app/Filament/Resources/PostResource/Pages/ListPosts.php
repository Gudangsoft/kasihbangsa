<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostCategoryResource;
use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('Categories')
                ->color('warning')
                ->icon('heroicon-o-queue-list')
                ->url(fn(): string => PostCategoryResource::getUrl('index'))
                ->visible(auth()->user()->isAdmin()),
        ];
    }
}
