<?php

namespace App\Filament\Resources\WebsiteActivationResource\Pages;

use App\Filament\Resources\WebsiteActivationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWebsiteActivation extends EditRecord
{
    protected static string $resource = WebsiteActivationResource::class;

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
