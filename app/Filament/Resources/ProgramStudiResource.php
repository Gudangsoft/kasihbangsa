<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\ProgramStudiResource\Pages;
use App\Models\ProgramStudi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramStudiResource extends Resource
{
    protected static ?string $model = ProgramStudi::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Program Studi';

    protected static ?string $modelLabel = 'Program Studi';
    protected static ?string $pluralModelLabel = 'Program Studi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Umum')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Program Studi')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Select::make('jenjang')
                            ->label('Jenjang')
                            ->options([
                                'D3' => 'D3 (Diploma)',
                                'D4' => 'D4 (Sarjana Terapan)',
                                'S1' => 'S1 (Sarjana)',
                                'S2' => 'S2 (Magister)',
                                'S3' => 'S3 (Doktor)',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('gelar')
                            ->label('Gelar Lulusan')
                            ->placeholder('S.E., S.Kom., M.M., dsb.')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('akreditasi')
                            ->label('Peringkat Akreditasi')
                            ->placeholder('Baik Sekali / Unggul / A / B'),

                        Forms\Components\TextInput::make('akreditasi_sk')
                            ->label('No. SK Akreditasi')
                            ->maxLength(255),

                        Forms\Components\FileUpload::make('image')
                            ->label('Foto/Ilustrasi Program Studi')
                            ->image()
                            ->directory('program-studi')
                            ->maxSize(2048)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->helperText('Ringkasan singkat, ditampilkan di kartu daftar program studi')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Visi, Misi & Tujuan')
                    ->schema([
                        Forms\Components\Textarea::make('visi')
                            ->label('Visi')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('misi')
                            ->label('Misi')
                            ->helperText('Satu baris = satu poin misi')
                            ->rows(4)
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn (?string $state) => self::linesToArray($state))
                            ->formatStateUsing(fn ($state) => self::arrayToLines($state)),

                        Forms\Components\Textarea::make('tujuan')
                            ->label('Tujuan')
                            ->helperText('Satu baris = satu poin tujuan')
                            ->rows(4)
                            ->columnSpanFull()
                            ->dehydrateStateUsing(fn (?string $state) => self::linesToArray($state))
                            ->formatStateUsing(fn ($state) => self::arrayToLines($state)),
                    ]),

                Forms\Components\Section::make('Kurikulum')
                    ->description('Susunan mata kuliah per semester. Gunakan tabel atau daftar bertingkat.')
                    ->schema([
                        TinyEditor::make('kurikulum')
                            ->label('')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('program-studi/images')
                            ->profile('full')
                            ->imagesUploadUrl(route('tinymce.upload'))
                            ->resize('both')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Profil Lulusan & Prospek Karir')
                    ->schema([
                        TinyEditor::make('profil_lulusan')
                            ->label('')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('program-studi/images')
                            ->profile('full')
                            ->imagesUploadUrl(route('tinymce.upload'))
                            ->resize('both')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Fasilitas')
                    ->schema([
                        TinyEditor::make('fasilitas')
                            ->label('')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('program-studi/images')
                            ->profile('full')
                            ->imagesUploadUrl(route('tinymce.upload'))
                            ->resize('both')
                            ->columnSpanFull(),
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
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Program Studi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenjang')
                    ->label('Jenjang')
                    ->badge(),

                Tables\Columns\TextColumn::make('akreditasi')
                    ->label('Akreditasi'),

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
            'index' => Pages\ListProgramStudis::route('/'),
            'create' => Pages\CreateProgramStudi::route('/create'),
            'edit' => Pages\EditProgramStudi::route('/{record}/edit'),
        ];
    }
}
