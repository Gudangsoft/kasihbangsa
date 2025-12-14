<?php

namespace App\Filament\Resources\WebsiteActivationResource\Pages;

use App\Filament\Resources\WebsiteActivationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWebsiteActivations extends ListRecords
{
    protected static string $resource = WebsiteActivationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->hidden(),
        ];
    }
}
