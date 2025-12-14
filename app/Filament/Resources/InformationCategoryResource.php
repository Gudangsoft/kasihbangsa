<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationCategoryResource\Pages;
use App\Filament\Resources\InformationCategoryResource\RelationManagers;
use App\Models\InformationCategory;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InformationCategoryResource extends Resource
{
    protected static ?string $model = InformationCategory::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->maxLength(255),
                Toggle::make('status')
                    ->label('Publish Status')
                    ->default(true)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')->searchable()->sortable()->label('Name'),
            TextColumn::make('status')->label('Published')->view('filament.tables.columns.status'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\ViewAction::make()
                ->label('Detail')
                ->icon('heroicon-o-eye'),
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\ForceDeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])->defaultSort('id', 'desc');
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
            'index' => Pages\ListInformationCategories::route('/'),
            'create' => Pages\CreateInformationCategory::route('/create'),
            'edit' => Pages\EditInformationCategory::route('/{record}/edit'),
        ];
    }
}
