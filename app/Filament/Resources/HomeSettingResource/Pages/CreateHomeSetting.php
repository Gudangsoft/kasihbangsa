<?php

namespace App\Filament\Resources\HomeSettingResource\Pages;

use App\Filament\Resources\HomeSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeSetting extends CreateRecord
{
    protected static string $resource = HomeSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Pengaturan beranda berhasil dibuat';
    }
}
