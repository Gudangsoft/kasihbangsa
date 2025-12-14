<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Widgets\UserOverview;
use App\Models\User;
use BezhanSalleh\FilamentShield\Support\Utils;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset as ComponentsFieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Navigation\NavigationItem;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = 'Management';
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Role' => count($record->getRoleNames()) > 0 ? $record->getRoleNames()[0] : null,
        ];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return UserResource::getUrl('view', ['record' => $record]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->columnSpan(6),
                TextInput::make('username')->columnSpan(6),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->columnSpan(6),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->label('Roles')
                    ->disabled(!auth()->user()->isAdmin())
                    ->columnSpan(6),
                FileUpload::make('profile_photo_path')
                    ->directory('avatars')
                    ->image()
                    ->avatar()
                    ->imageEditor()
                    ->circleCropper()
                    ->nullable()
                    ->downloadable()
                    ->maxSize(5120) // 5MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
                    ->columnSpanFull(),
                Fieldset::make('userData')
                    ->label('Data User')
                    ->relationship('userData')
                    ->schema([
                        RichEditor::make('about')
                            ->label('About Me')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('richeditor/images')
                            ->fileAttachmentsVisibility('public'),
                        Textarea::make('address')->rows(3),
                        TextInput::make('wa')->placeholder('62xxxx')->label('Nomor Whatsapp'),
                        TextInput::make('ig')->placeholder('https://')->label('Link Instagram'),
                        TextInput::make('fb')->placeholder('https://')->label('Link Facebook'),
                        TextInput::make('x')->placeholder('https://')->label('Link X'),
                        TextInput::make('linkedin')->placeholder('https://')->label('Link Linkedin'),
                    ])->columns(1),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->circular(),
                TextColumn::make('name')->searchable()->label('Name'),
                TextColumn::make('email')->searchable()->label('Email')->copyable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Roles')
                    ->sortable()
                    ->wrap()
                    ->badge()
                    ->colors([
                        'primary', // Warna default untuk badge
                    ]),
                TextColumn::make('created_at')->dateTime()->label('Created At'),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();
                if ($user->hasRole('super_admin')) {
                    return $query;
                } else {
                    return $query->where('id', $user->id);
                }
            })
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Detail')
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('reset_password')
                        ->label('Reset Password')
                        ->icon('heroicon-o-key')
                        ->requiresConfirmation()
                        ->action(function (\App\Models\User $record) {
                            $newPassword = 12345678; // Generate password baru
                            $record->password = Hash::make($newPassword);
                            $record->save();

                            // Kirim notifikasi atau simpan info password ke log (tergantung kebutuhanmu)
                            Notification::make()
                                ->title('Password Reset')
                                ->body("Password baru: $newPassword")
                                ->success()
                                ->send();
                        }),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),

                ])
                    // ->icon('heroicon-o-arrow-down-circle')
                    ->tooltip('Action')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // BulkAction::make('Change Role Guest')
                    //     ->label('Change Role Guest')
                    //     ->action(function ($records) {
                    //         foreach ($records as $user) {
                    //             $user->assignRole('guest');
                    //         }
                    //     })
                    //     ->requiresConfirmation()
                    //     ->icon('heroicon-s-shield-check')
                    //     ->color('success'),
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ])
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
            'view' => Pages\ViewUser::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                Section::make('User Information')
                    ->schema([
                        Grid::make([
                            'default' => 1,
                            'sm' => 2,
                            'md' => 3,
                            'lg' => 4,
                            'xl' => 6,
                            '2xl' => 8,
                        ])->schema([
                            ImageEntry::make('avatar')
                                ->circular()
                                ->size(100)
                                ->label('Profile Picture'),

                            Grid::make(4)->schema([
                                TextEntry::make('name')
                                    ->label('Full Name')
                                    ->weight('bold')
                                    ->size('xl'),
                                TextEntry::make('username')
                                    ->label('Username')
                                    ->weight('bold')
                                    ->size('xl'),
                                TextEntry::make('email')
                                    ->icon('heroicon-o-envelope')
                                    ->copyable(),
                                TextEntry::make('roles.name')
                                    ->label('Role')
                                    ->badge('primary')
                            ]),
                            ComponentsFieldset::make('userData')
                                ->label('Data User')
                                ->relationship('userData')
                                ->schema([
                                    TextEntry::make('about')
                                        ->formatStateUsing(fn(string $state): HtmlString => new HtmlString($state)),
                                    TextEntry::make('wa')->color('success')->label('Nomor Whatsapp')->copyable(),
                                    TextEntry::make('ig')->color('primary')->label('Link Instagram')->url(fn($record) => $record->ig)->copyable(),
                                    TextEntry::make('fb')->color('primary')->url(fn($record) => $record->fb)->label('Link Facebook')->copyable(),
                                    TextEntry::make('x')->color('primary')->url(fn($record) => $record->x)->label('Link X')->copyable(),
                                    TextEntry::make('linkedin')->color('primary')->url(fn($record) => $record->linkedin)->label('Link Linkedin')->copyable(),
                                ])->columns(1)
                        ]),
                    ]),
            ]);
    }


    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make('Users')
                ->url(static::getUrl())
                ->icon(static::getNavigationIcon())
                ->group(static::getNavigationGroup())
                ->visible(fn() => auth()->user()->hasRole('super_admin'))
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return Utils::isResourceNavigationGroupEnabled()
            ? 'Management'
            : '';
    }
    public static function getWidgets(): array
    {
        return [
            UserOverview::class,
        ];
    }
}
