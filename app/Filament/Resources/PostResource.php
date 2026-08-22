<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\BuilderHelpers;
use Illuminate\Support\Facades\Auth;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Berita';

    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Berita';

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->unique(table: 'posts', column: 'title', ignoreRecord: true)
                    ->required()
                    ->maxLength(255)
                    ->validationMessages([
                        'unique' => 'Judul ini sudah digunakan. Silakan gunakan judul lain.',
                        'required' => 'Judul wajib diisi.',
                        'max' => 'Judul tidak boleh lebih dari :max karakter.',
                    ])->columnSpan('full'),
                Textarea::make('preview')
                    ->maxLength(255)
                    ->columnSpan('full'),
                // RichEditor::make('content')
                //     ->required()
                //     ->columnSpan('full'),
                TinyEditor::make('content')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('uploads')
                    ->profile('full')
                    ->imagesUploadUrl(route('tinymce.upload'))
                    ->resize('both')
                    ->columnSpan('full')
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->maxSize(5120) // 5MB
                    ->directory('posts/images')
                    ->columnSpan(6),
                DateTimePicker::make('publish_at')
                    ->timezone("Asia/Jakarta")
                    ->displayFormat('d/m/Y H:i')
                    ->native(false)
                    ->default(now())
                    ->withoutSeconds()
                    ->columnSpan(6),
                Select::make('category_id')
                    ->relationship('category', 'name', function ($query) {
                        $query->where('status', true);
                    })
                    ->required()
                    ->columnSpan(6),
                TextInput::make('tags')
                    ->label('Tags (comma-separated)')
                    ->placeholder('tag1, tag2, tag3')
                    ->columnSpan(6),
                Toggle::make('status')
                    ->label('Publish Status')
                    ->default(true)
                    ->columnSpan(6),
            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable()->label('Title'),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->wrap()
                    ->badge('sm')
                    ->colors([
                        'warning',
                    ]),
                TextColumn::make('user.name')
                    ->label('Author')
                    ->badge()
                    ->color('primary')
                    ->icon('heroicon-o-user-circle'),
                TextColumn::make('tags')->limit(20),
                TextColumn::make('status')->label('Published')->view('filament.tables.columns.status'),
                TextColumn::make('publish_at')->dateTime()->sortable(),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $user = Auth::user();

                if ($user->hasRole('super_admin')) {
                    return $query;
                } else {
                    return $query->where('created_by', $user->id);
                }
            })
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                        Select::make('status')
                            ->options([
                                'false' => 'Hide',
                                'true' => 'Published',
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('publish_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('publish_at', '<=', $date),
                            )->when(
                                $data['status'],
                                fn(Builder $query, $data): Builder => $query->where('status', $data),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Detail')
                        ->icon('heroicon-o-eye'),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                ])
                    ->tooltip('Action')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
