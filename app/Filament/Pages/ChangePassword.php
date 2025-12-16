<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class ChangePassword extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationIcon = 'heroicon-o-key';
    protected static string $view = 'filament.pages.change-password';
    protected static ?string $title = 'Ganti Password';
    protected static ?string $slug = 'change-password';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('current_password')
                ->label('Password Lama')
                ->password()
                ->required()
                ->rule('current_password')
                ->statePath('data.current_password'),

            Forms\Components\TextInput::make('password')
                ->label('Password Baru')
                ->password()
                ->required()
                ->minLength(8)
                ->same('data.password_confirmation')
                ->statePath('data.password'),

            Forms\Components\TextInput::make('password_confirmation')
                ->label('Konfirmasi Password')
                ->password()
                ->required()
                ->statePath('data.password_confirmation'),
        ];
    }


    protected function getFormModel(): \Illuminate\Database\Eloquent\Model|string|null
    {
        return auth()->user() instanceof User ? auth()->user() : null;
    }

    public function submit(): void
    {
        $data = $this->form->getState()['data'];

        auth()->user()->update([
            'password' => Hash::make($data['password']),
        ]);

        Notification::make()
            ->title('Password berhasil diganti')
            ->success()
            ->send();

        $this->form->fill(); // reset form
        redirect()->route('filament.admin.pages.dashboard');
    }
}
