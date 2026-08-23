<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Traits\HasShieldFormComponents;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    use HasShieldFormComponents;

    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationLabel = 'Menu';

    protected static ?string $modelLabel = 'Menu';
    protected static ?string $pluralModelLabel = 'Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                Select::make('category')
                    ->label('Tampil di')
                    ->options([
                        'home' => 'Menu Utama (Header)',
                        'footer' => 'Link Custom (Footer)',
                    ])
                    ->default('home')
                    ->required()
                    ->live(),
                TextInput::make('url')
                    ->label('Url/Slug'),
                Select::make('link_type')
                    ->label('Jenis Link')
                    ->helperText('Menentukan link ini masuk kolom "Link Internal" atau "Link External" di footer, terlepas dari format URL-nya (boleh sama-sama https:// dan buka tab baru).')
                    ->options([
                        'internal' => 'Link Internal (contoh: PMB, SIAKAD, Perpustakaan milik sendiri)',
                        'external' => 'Link External (contoh: LLDIKTI, situs pihak lain)',
                    ])
                    ->default('internal')
                    ->required()
                    ->visible(fn (Forms\Get $get): bool => $get('category') === 'footer'),
                Toggle::make('submenu')
                    ->label('Sub Menu ?')
                    ->default(false),
                Select::make('parent_id')
                    ->label('Parent menu')
                    ->options(Menu::where('submenu', 0)->get()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
                Toggle::make('status')
                    ->label('is Published ?')
                    ->default(true),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->reorderable('number')
            ->columns([
                TextColumn::make('name')->searchable()->sortable()->label('Name')->searchable()
                    ->icon(function (Model $record) {
                        if ($record->submenu != 0) {
                            return 'heroicon-o-arrow-turn-down-right';
                        }
                    }),
                TextColumn::make('url')->label('Slug / Url'),
                TextColumn::make('number')->label('Number')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('parent')->label('Parent Menu')->badge()->color('warning')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('category')->label('Tampil di')->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'footer' => 'Footer',
                        default => 'Header',
                    })
                    ->color(fn (string $state): string => $state === 'footer' ? 'success' : 'primary'),
                TextColumn::make('link_type')->label('Jenis Link')->badge()
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'external' => 'External',
                        default => 'Internal',
                    })
                    ->color(fn (?string $state): string => $state === 'external' ? 'warning' : 'gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                BooleanColumn::make('submenu')->label('is Sub Menu')
                    ->toggleable(isToggledHiddenByDefault: true),
                BooleanColumn::make('status')->label('is Active'),
            ])
            ->defaultSort('number', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Tampil di')
                    ->options([
                        'home' => 'Header',
                        'footer' => 'Footer',
                    ]),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
