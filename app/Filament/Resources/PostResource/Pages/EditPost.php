<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function handleRecordUpdate(Model $record, array $data) : Model
    {
        $data['slug'] = Str::slug($data['title']);
        $data['created_by'] = Auth::user()->id;

        if(is_array($data['tags']))
        {
            $tagsString = implode(",", $data['tags']);
        }else{
            $tagsString = $data['tags'];
        }

        $data['tags'] = array_map('trim', explode(',', $tagsString));

        $record->update($data);

        return $record;
    }

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
