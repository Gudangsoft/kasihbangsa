<?php

namespace App\Filament\Pages\Auth;

use App\Filament\Pages\Dashboard;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Pages\Auth\Login as BaseLogin;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    public int $captchaA = 0;

    public int $captchaB = 0;

    public function mount(): void
    {
        parent::mount();

        $this->generateCaptcha();
    }

    protected function generateCaptcha(): void
    {
        $this->captchaA = random_int(1, 10);
        $this->captchaB = random_int(1, 10);

        session(['login_captcha_answer' => $this->captchaA + $this->captchaB]);
    }

    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        $expected = session('login_captcha_answer');
        $given = $data['captcha'] ?? null;

        if ($expected === null || $given === null || (int) $given !== (int) $expected) {
            $this->generateCaptcha();

            throw ValidationException::withMessages([
                'data.captcha' => 'Jawaban penjumlahan salah, silakan coba lagi.',
            ]);
        }

        try {
            $response = parent::authenticate();
        } finally {
            // Regenerate the question after every attempt (success or failure)
            // so a captured answer can't be replayed.
            $this->generateCaptcha();
        }

        if ($response !== null) {
            // Filament's default LoginResponse redirects to the first
            // navigation item's URL, which isn't necessarily the dashboard
            // (e.g. a custom "visit site" nav link). Send admins straight
            // to the dashboard instead.
            $this->redirect(Dashboard::getUrl());

            return null;
        }

        return $response;
    }

    /**
     * @return array<int | string, string | \Filament\Forms\Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getCaptchaFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getCaptchaFormComponent(): Component
    {
        return TextInput::make('captcha')
            ->label(fn (): string => "Keamanan: berapa {$this->captchaA} + {$this->captchaB} ?")
            ->numeric()
            ->required()
            ->extraInputAttributes(['tabindex' => 3])
            ->autocomplete('off');
    }
}
