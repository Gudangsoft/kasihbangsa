<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // dd($data);
        $this->record->update($data);

        // Update relasi userData jika ada
        if (isset($data['userData'])) {
            $this->record->userData()->updateOrCreate([], $data['userData']);
        }

        // Update roles jika diubah
        if (!empty($data['roles'])) {
            $roleNames = \Spatie\Permission\Models\Role::whereIn('id', (array) $data['roles'])->pluck('name')->toArray();
            $this->record->syncRoles($roleNames);
        }

        return $record;
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
        Notification::make()
            ->title('User updated successfully!')
            ->success()
            ->send();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
