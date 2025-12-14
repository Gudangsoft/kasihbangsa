<?php

namespace App\Filament\Resources\KerjaSamaResource\Pages;

use App\Filament\Resources\KerjaSamaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateKerjaSama extends CreateRecord
{
    protected static string $resource = KerjaSamaResource::class;

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Created Success')
            ->body('Data kerja sama berhasil ditambahkan.');
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
