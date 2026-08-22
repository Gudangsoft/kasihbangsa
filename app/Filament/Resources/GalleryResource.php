<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?int $navigationSort = 6;

    protected static ?string $modelLabel = 'Gallery Foto';
    protected static ?string $pluralModelLabel = 'Gallery Foto';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Kategori')
                    ->options(GalleryCategory::pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required(),
                    // ->live(debounce: 500)
                    // ->afterStateUpdated(
                    //     fn($state, callable $set, $get) =>
                    //     $get('slug') ?: $set('slug', Str::slug($state))
                    // ),
                // ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->nullable(),

                Forms\Components\Select::make('type')
                    ->label('Jenis Galeri')
                    ->options([
                        'photo' => 'Foto',
                        'video' => 'Video (Link YouTube)',
                    ])
                    ->default('photo')
                    ->required()
                    ->live(),

                Forms\Components\TextInput::make('youtube_url')
                    ->label('Link YouTube')
                    ->url()
                    ->placeholder('https://www.youtube.com/watch?v=...')
                    ->helperText('Tempel link video YouTube (watch, share, atau embed).')
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'video')
                    ->required(fn (Forms\Get $get): bool => $get('type') === 'video'),

                // FileUpload::make('image_path')
                //     ->label('Gambar')
                //     ->image()
                //     ->directory('gallery')
                //     ->required(),
                Repeater::make('images')
                    ->relationship('images') // Relasi ke gallery_images
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Gambar')
                            ->image()
                            ->directory('gallery')
                            ->required(),
                    ])
                    ->columns(1)
                    ->addActionLabel('Tambah Gambar')
                    ->visible(fn (Forms\Get $get): bool => $get('type') !== 'video')
                    ->minItems(fn (Forms\Get $get): int => $get('type') === 'video' ? 0 : 1),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->label('Gambar')
                    ->getStateUsing(fn (Gallery $record): ?string => $record->isVideo()
                        ? $record->youtube_thumbnail_url
                        : $record->images->first()?->image),
                Tables\Columns\TextColumn::make('title')->label('Judul')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === 'video' ? 'Video' : 'Foto')
                    ->color(fn (string $state): string => $state === 'video' ? 'danger' : 'success'),
                Tables\Columns\TextColumn::make('description')->label('Deskripsi')->limit(50),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Jenis Galeri')
                    ->options([
                        'photo' => 'Foto',
                        'video' => 'Video (Link YouTube)',
                    ]),
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
