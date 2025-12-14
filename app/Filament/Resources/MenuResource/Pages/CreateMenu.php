<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use App\Models\Menu;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateMenu extends CreateRecord
{
    protected static string $resource = MenuResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);

        // Jika parent_id NULL, ubah menjadi 0 (menu utama)
        $data['parent_id'] = $data['parent_id'] ?? 0;

        // Set nomor menu berdasarkan parent_id
        $data['number'] = Menu::generateMenuNumber($data['parent_id']);

        return $data;
    }

    // protected function handleRecordCreation(array $data) : Model
    // {
    //     $data['parent_id'] = $data['parent_id'] ?? 0;
    //     $lastNumber = Menu::latest()->first();
    //     // $data['number'] = isset($lastNumber->number) ? $lastNumber->number + 1 : 1;

    //     return static::getModel()::create($data);
    // }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
