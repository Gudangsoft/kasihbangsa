<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        // dd($data);
        $data['password'] = Hash::make('cdaaptnia');

        $user = static::getModel()::create($data);

        if (!empty($data['roles'])) {
            $roleNames = \Spatie\Permission\Models\Role::whereIn('id', (array) $data['roles'])->pluck('name')->toArray();
            $user->assignRole($roleNames);
        }

        return $user;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['userData']['wa'])) {
            $data['userData']['wa'] = preg_replace('/\s+/', '', $data['userData']['wa']);
        }

        return $data;
    }

    protected function afterSave(): void
    {
        if (isset($this->form->getState()['userData']['about'])) {
            Notification::make()
                ->title('Data relasi berhasil disimpan!')
                ->success()
                ->send();
        }
    }

    protected function beforeSave(): void
    {
        $this->record->userData()->updateOrCreate(
            [],
            $this->form->getState()['userData'] ?? []
        );
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

}
