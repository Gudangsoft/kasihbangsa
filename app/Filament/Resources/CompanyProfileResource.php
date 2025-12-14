<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyProfileResource\Pages;
use App\Filament\Resources\CompanyProfileResource\RelationManagers;
use App\Models\CompanyProfile;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyProfileResource extends Resource
{
    protected static ?string $model = CompanyProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationLabel = 'Website Profile';

    protected static ?string $modelLabel = 'Website Profile';
    protected static ?string $pluralModelLabel = 'Website Profile';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->columnSpanFull(),
                FileUpload::make('logo')
                    ->directory('logo')
                    ->image()
                    ->nullable()
                    ->downloadable()
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png'])->columnSpanFull(),

                Textarea::make('description')
                    ->rows(5)
                    ->columnSpan(6),
                Textarea::make('address')
                    ->rows(5)
                    ->columnSpan(6),

                TextInput::make('phone')
                    ->numeric()
                    ->maxLength(14)
                    ->columnSpan(4),
                TextInput::make('email')
                    ->email()
                    ->columnSpan(4),
                TextInput::make('website')->type('url')
                    ->columnSpan(4),
                Textarea::make('meta_title')
                    ->rows(4)
                    ->columnSpan(4),
                Textarea::make('meta_keywords')
                    ->rows(4)
                    ->columnSpan(4),
                Textarea::make('meta_description')
                    ->rows(4)
                    ->columnSpan(4),


            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->width(150)
                ->url(fn(string $state): string => url(asset($state))),
                TextColumn::make('name'),
                TextColumn::make('description')->limit(50),
                TextColumn::make('phone'),
                TextColumn::make('email')->copyable(),
                TextColumn::make('website'),
                TextColumn::make('website')
                    ->url(fn(): string => url(config('app.url')))
                    ->openUrlInNewTab()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCompanyProfiles::route('/'),
            'create' => Pages\CreateCompanyProfile::route('/create'),
            'edit' => Pages\EditCompanyProfile::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return false;
    }
}
