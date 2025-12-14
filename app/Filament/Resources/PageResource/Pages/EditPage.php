<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Menu;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $data['slug'] = Str::slug($data['title']);

        // dd($data['menu_id']);
        if ($data['menu_id']) {
            $menu_clear_url = Menu::where('url', '/page/' . $record->slug)->update([
                'url' => '#',
            ]);

            if ($menu_clear_url) {
                Menu::where('id', $data['menu_id'])->update([
                    'url' => '/page/' . $data['slug'],
                ]);
            }
        }
        unset($data['menu_id']);
        $record->update($data);

        return $record;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $menu = Menu::where('url', '/page/' . $data['slug'])->first();

        if ($menu) {
            $data['menu_id'] = $menu->id;
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
