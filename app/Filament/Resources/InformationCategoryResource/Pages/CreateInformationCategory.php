<?php

namespace App\Filament\Resources\InformationCategoryResource\Pages;

use App\Filament\Resources\InformationCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateInformationCategory extends CreateRecord
{
    protected static string $resource = InformationCategoryResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $data['slug'] = Str::slug($data['name']);

        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
