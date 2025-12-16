<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Guide extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationLabel = 'Panduan Penggunaan';

    protected static ?string $title = 'Panduan Penggunaan Dashboard';

    protected static ?int $navigationSort = 99;

    protected static ?string $navigationGroup = 'Bantuan';

    protected static string $view = 'filament.pages.guide';

    public function getHeading(): string
    {
        return 'Panduan Penggunaan Dashboard';
    }
}
