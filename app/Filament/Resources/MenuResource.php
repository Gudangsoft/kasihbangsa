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
                TextInput::make('url')
                    ->label('Url/Slug'),
                Toggle::make('submenu')
                    ->label('Sub Menu ?')
                    ->default(false),
                Select::make('parent_id')
                    ->label('Parent menu')
                    ->options(Menu::where('submenu', 0)->get()->pluck('name', 'id'))
                    ->searchable()
                    ->nullable(),
                Select::make('category')
                    ->label('Tampil di')
                    ->options([
                        'home' => 'Menu Utama (Header)',
                        'footer' => 'Link Custom (Footer)',
                    ])
                    ->default('home')
                    ->required(),
                Toggle::make('status')
                    ->label('is Published ?')
                    ->default(true),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->columns([
                TextColumn::make('name')->searchable()->sortable()->label('Name')->searchable()
                    ->icon(function (Model $record) {
                        if ($record->submenu != 0) {
                            return 'heroicon-o-arrow-turn-down-right';
                        }
                    }),
                TextColumn::make('url')->label('Slug / Url'),
                TextColumn::make('number')->label('Number'),
                TextColumn::make('parent')->label('Parent Menu')->badge()->color('warning'),
                TextColumn::make('category')->label('Tampil di')->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'footer' => 'Footer',
                        default => 'Header',
                    })
                    ->color(fn (string $state): string => $state === 'footer' ? 'success' : 'primary'),
                BooleanColumn::make('submenu')->label('is Sub Menu'),
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
                Tables\Actions\Action::make('moveUp')
                    ->label('Move Up')
                    ->icon('heroicon-o-chevron-up')
                    ->color('primary')
                    ->button()
                    ->action(fn (Model $record) => $record->moveUp())
                    ->hidden(fn (Model $record) => !$record->canMoveUp()), // Tombol dinonaktifkan jika sudah paling atas

                Tables\Actions\Action::make('moveDown')
                    ->label('Move Down')
                    ->icon('heroicon-o-chevron-down')
                    ->color('info')
                    ->button()
                    ->action(fn (Model $record) => $record->moveDown())
                    ->hidden(fn (Model $record) => !$record->canMoveDown()), // Tombol dinonaktifkan jika sudah paling bawah


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
