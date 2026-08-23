<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KerjaSamaResource\Pages;
use App\Filament\Resources\KerjaSamaResource\RelationManagers;
use App\Models\KerjaSama;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class KerjaSamaResource extends Resource
{
    protected static ?string $model = KerjaSama::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Layanan & Interaksi';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationLabel = 'Data Kerja sama';

    protected static ?string $modelLabel = 'Data Kerja sama';
    protected static ?string $pluralModelLabel = 'Data Kerja sama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->maxLength(50),
                TextInput::make('lembaga_mitra')->required()->maxLength(255),
                Toggle::make('internasional')->label('Internasional'),
                Toggle::make('nasional')->label('Nasional'),
                Toggle::make('wilayah_lokal')->label('Wilayah / Lokal'),
                TextInput::make('judul_kerja_sama')->required()->maxLength(255),
                Textarea::make('manfaat')->nullable()->maxLength(500),
                FileUpload::make('dokumen')
                    ->nullable()
                    ->directory('dokumen-kerja-sama')
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->replace(' ', '_')
                            ->prepend('STPdianmandala_'),
                    ),
                DatePicker::make('start_date')->label('Tanggal Mulai')->nullable(),
                DatePicker::make('end_date')->label('Tanggal Berakhir')->nullable(),
                Toggle::make('status')->default(true)->label('Status Aktif'),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode')->searchable()->sortable(),
                TextColumn::make('lembaga_mitra')->searchable(),
                BooleanColumn::make('internasional')->label('Internasional'),
                BooleanColumn::make('nasional')->label('Nasional'),
                BooleanColumn::make('wilayah_lokal')->label('Wilayah/Lokal'),
                TextColumn::make('judul_kerja_sama')->searchable(),
                TextColumn::make('start_date')->date()->label('Mulai')->sortable(),
                TextColumn::make('end_date')->date()->label('Berakhir')->sortable(),
                TextColumn::make('durasi'),
                BooleanColumn::make('status')
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('status')->label('Status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListKerjaSamas::route('/'),
            'create' => Pages\CreateKerjaSama::route('/create'),
            'edit' => Pages\EditKerjaSama::route('/{record}/edit'),
        ];
    }
}
