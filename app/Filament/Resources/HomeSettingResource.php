<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeSettingResource\Pages;
use App\Models\HomeSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HomeSettingResource extends Resource
{
    protected static ?string $model = HomeSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationLabel = 'Pengaturan Beranda';

    protected static ?string $modelLabel = 'Pengaturan Beranda';

    protected static ?string $navigationGroup = 'Pengaturan Website';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        // About Section Tab
                        Forms\Components\Tabs\Tab::make('Tentang Kami')
                            ->icon('heroicon-o-information-circle')
                            ->schema([
                                Forms\Components\Section::make('About Section')
                                    ->description('Pengaturan untuk bagian Tentang Kami di halaman beranda')
                                    ->schema([
                                        Forms\Components\TextInput::make('about_title')
                                            ->label('Judul')
                                            ->maxLength(255)
                                            ->placeholder('Tentang STP Dian Mandala'),

                                        Forms\Components\TextInput::make('about_subtitle')
                                            ->label('Subjudul')
                                            ->maxLength(255)
                                            ->placeholder('Sekolah Tinggi Pastoral'),

                                        Forms\Components\Textarea::make('about_description')
                                            ->label('Deskripsi')
                                            ->rows(5)
                                            ->columnSpanFull()
                                            ->placeholder('Deskripsi lengkap tentang institusi...'),

                                        Forms\Components\FileUpload::make('about_image')
                                            ->label('Gambar')
                                            ->image()
                                            ->directory('home-settings')
                                            ->maxSize(2048)
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('about_video_url')
                                            ->label('URL Video YouTube')
                                            ->url()
                                            ->placeholder('https://www.youtube.com/watch?v=...')
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ]),

                        // Stats Section Tab
                        Forms\Components\Tabs\Tab::make('Statistik')
                            ->icon('heroicon-o-chart-bar')
                            ->schema([
                                Forms\Components\Section::make('Program Studi')
                                    ->schema([
                                        Forms\Components\TextInput::make('stat_programs')
                                            ->label('Jumlah')
                                            ->numeric()
                                            ->required()
                                            ->default(5)
                                            ->suffix('+'),

                                        Forms\Components\TextInput::make('stat_programs_label')
                                            ->label('Label')
                                            ->required()
                                            ->default('Program Studi')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Mahasiswa')
                                    ->schema([
                                        Forms\Components\TextInput::make('stat_students')
                                            ->label('Jumlah')
                                            ->numeric()
                                            ->required()
                                            ->default(500)
                                            ->suffix('+'),

                                        Forms\Components\TextInput::make('stat_students_label')
                                            ->label('Label')
                                            ->required()
                                            ->default('Mahasiswa Aktif')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Dosen')
                                    ->schema([
                                        Forms\Components\TextInput::make('stat_lecturers')
                                            ->label('Jumlah')
                                            ->numeric()
                                            ->required()
                                            ->default(50)
                                            ->suffix('+'),

                                        Forms\Components\TextInput::make('stat_lecturers_label')
                                            ->label('Label')
                                            ->required()
                                            ->default('Dosen Profesional')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),

                                Forms\Components\Section::make('Akreditasi')
                                    ->schema([
                                        Forms\Components\TextInput::make('stat_accreditation')
                                            ->label('Nilai')
                                            ->required()
                                            ->default('A')
                                            ->maxLength(10),

                                        Forms\Components\TextInput::make('stat_accreditation_label')
                                            ->label('Label')
                                            ->required()
                                            ->default('Akreditasi')
                                            ->maxLength(255),
                                    ])
                                    ->columns(2),
                            ]),

                        // Contact Section Tab
                        Forms\Components\Tabs\Tab::make('Kontak')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\Section::make('Contact Section')
                                    ->description('Pengaturan untuk bagian kontak di halaman beranda')
                                    ->schema([
                                        Forms\Components\TextInput::make('contact_title')
                                            ->label('Judul')
                                            ->required()
                                            ->default('Kotak Layanan STP Dian Mandala')
                                            ->maxLength(255)
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('contact_subtitle')
                                            ->label('Subjudul')
                                            ->maxLength(255)
                                            ->placeholder('Hubungi Kami')
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('contact_description')
                                            ->label('Deskripsi')
                                            ->rows(3)
                                            ->default('Kirimkan pesan kepada kami, kami akan membalas Anda melalui email dalam waktu 24 jam.')
                                            ->columnSpanFull(),

                                        Forms\Components\Textarea::make('map_embed_url')
                                            ->label('URL Embed Google Maps')
                                            ->rows(3)
                                            ->placeholder('https://www.google.com/maps/embed?pb=...')
                                            ->helperText('Masukkan URL embed dari Google Maps. Cara: Buka Google Maps > Pilih lokasi > Share > Embed a map > Copy HTML')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // Footer Tab
                        Forms\Components\Tabs\Tab::make('Footer')
                            ->icon('heroicon-o-arrow-down-circle')
                            ->schema([
                                Forms\Components\Section::make('Footer Settings')
                                    ->description('Pengaturan untuk footer website')
                                    ->schema([
                                        Forms\Components\Textarea::make('footer_description')
                                            ->label('Deskripsi Footer')
                                            ->rows(4)
                                            ->placeholder('Sekolah Tinggi Pastoral Dian Mandala adalah lembaga pendidikan tinggi Katolik...')
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('footer_copyright')
                                            ->label('Copyright Text')
                                            ->maxLength(255)
                                            ->placeholder('© 2024 STP Dian Mandala. All rights reserved.')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('about_title')
                    ->label('Judul About')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('stat_programs')
                    ->label('Program Studi')
                    ->suffix('+'),

                Tables\Columns\TextColumn::make('stat_students')
                    ->label('Mahasiswa')
                    ->suffix('+'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->paginated(false);
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
            'index' => Pages\ListHomeSettings::route('/'),
            'create' => Pages\CreateHomeSetting::route('/create'),
            'edit' => Pages\EditHomeSetting::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return HomeSetting::count() === 0;
    }
}
