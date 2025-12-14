<?php

namespace App\Filament\Resources\InformationCategoryResource\Pages;

use App\Filament\Resources\InformationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInformationCategory extends EditRecord
{
    protected static string $resource = InformationCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
