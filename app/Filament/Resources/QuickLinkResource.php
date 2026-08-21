<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuickLinkResource\Pages;
use App\Models\QuickLink;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class QuickLinkResource extends Resource
{
    protected static ?string $model = QuickLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Tombol Layanan';
    protected static ?string $modelLabel = 'Tombol Layanan';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->label('Gambar Latar ( rekomendasi 800 x 600 pixel, opsional )')
                    ->image()
                    ->directory('quick-links')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '4:3',
                    ])
                    ->maxSize(10240),
                TextInput::make('title')
                    ->label('Judul Tombol')
                    ->required(),
                TextInput::make('url')
                    ->label('URL Tujuan')
                    ->helperText('Bisa alamat penuh (https://...) atau path internal (contoh: /informasi)')
                    ->required(),
                TextInput::make('icon')
                    ->label('Icon ( opsional, nama heroicon, cth: heroicon-o-academic-cap )')
                    ->helperText('Ditampilkan jika gambar latar tidak diisi. Lihat daftar di heroicons.com'),
                TextInput::make('number')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
                Toggle::make('status')
                    ->label('Aktif')
                    ->default(true),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('number')
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar'),
                TextColumn::make('title')
                    ->label('Judul'),
                TextColumn::make('url')
                    ->label('URL')
                    ->url(fn ($state): string => $state)
                    ->openUrlInNewTab(),
                TextColumn::make('number')
                    ->label('Urutan'),
                Tables\Columns\BooleanColumn::make('status')
                    ->label('Aktif'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuickLinks::route('/'),
            'create' => Pages\CreateQuickLink::route('/create'),
            'edit' => Pages\EditQuickLink::route('/{record}/edit'),
        ];
    }
}
