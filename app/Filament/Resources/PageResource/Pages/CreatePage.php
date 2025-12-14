<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Menu;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function handleRecordCreation(array $data) : Model
    {
        $data['slug'] = Str::slug($data['title']);
        $data['created_by'] = Auth::user()->id;

        $data['slug'] = Str::slug($data['title']);

        // dd($data['menu_id']);
        if ($data['menu_id']) {
            Menu::where('id', $data['menu_id'])->update([
                'url' => '/page/' . $data['slug'],
            ]);
        }

        unset($data['menu_id']);

        return static::getModel()::create($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
