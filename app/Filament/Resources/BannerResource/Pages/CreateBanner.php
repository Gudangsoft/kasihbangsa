<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateBanner extends CreateRecord
{
    protected static string $resource = BannerResource::class;

    protected function handleRecordCreation(array $data) : Model
    {
        $data['slug'] = Str::slug($data['title']);
        $data['created_by'] = Auth::user()->id;

        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
