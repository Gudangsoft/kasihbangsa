<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DosenResource\Pages;
use App\Models\Dosen;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DosenResource extends Resource
{
    protected static ?string $model = Dosen::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationLabel = 'Dosen';

    protected static ?string $modelLabel = 'Dosen';
    protected static ?string $pluralModelLabel = 'Dosen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Dosen')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap (dengan gelar)')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('nidn')
                            ->label('NIDN')
                            ->maxLength(50),

                        Forms\Components\TextInput::make('prodi')
                            ->label('Program Studi')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('jabatan_akademik')
                            ->label('Jabatan Akademik')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('jabatan_institusi')
                            ->label('Jabatan Institusi')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('status_dosen')
                            ->label('Status Dosen')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('sertifikasi_dosen')
                            ->label('No. Sertifikasi Dosen')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('dosen')
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Riwayat & Aktivitas')
                    ->description('Satu baris = satu item. Kosongkan jika belum ada datanya.')
                    ->schema([
                        Forms\Components\Textarea::make('riwayat_pendidikan')
                            ->label('Riwayat Pendidikan')
                            ->rows(4)
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn (?string $state) => self::linesToArray($state))
                            ->formatStateUsing(fn ($state) => self::arrayToLines($state)),

                        Forms\Components\Textarea::make('penelitian')
                            ->label('Penelitian')
                            ->rows(4)
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn (?string $state) => self::linesToArray($state))
                            ->formatStateUsing(fn ($state) => self::arrayToLines($state)),

                        Forms\Components\Textarea::make('pengabdian_masyarakat')
                            ->label('Pengabdian Masyarakat')
                            ->rows(4)
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn (?string $state) => self::linesToArray($state))
                            ->formatStateUsing(fn ($state) => self::arrayToLines($state)),

                        Forms\Components\Textarea::make('capaian_khusus')
                            ->label('Capaian Khusus')
                            ->rows(3)
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn (?string $state) => self::linesToArray($state))
                            ->formatStateUsing(fn ($state) => self::arrayToLines($state)),
                    ]),

                Forms\Components\Section::make('Publikasi')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),

                        Forms\Components\Toggle::make('status')
                            ->label('Tampilkan di Website')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    protected static function linesToArray(?string $state): ?array
    {
        if (! $state) {
            return null;
        }

        $lines = array_values(array_filter(array_map('trim', explode("\n", $state)), fn ($l) => $l !== ''));

        return $lines ?: null;
    }

    protected static function arrayToLines($state): ?string
    {
        if (! $state) {
            return null;
        }

        return implode("\n", (array) $state);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('prodi')
                    ->label('Program Studi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('jabatan_institusi')
                    ->label('Jabatan')
                    ->toggleable(),

                Tables\Columns\IconColumn::make('status')
                    ->label('Aktif')
                    ->boolean(),

                Tables\Columns\TextColumn::make('order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('order')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDosens::route('/'),
            'create' => Pages\CreateDosen::route('/create'),
            'edit' => Pages\EditDosen::route('/{record}/edit'),
        ];
    }
}
