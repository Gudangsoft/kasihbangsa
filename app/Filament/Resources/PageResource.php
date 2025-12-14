<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Menu;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';
    protected static ?int $navigationSort = 9;
    // protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    TextInput::make('title')->label('Judul Halaman')->required(),
                ]),
                Section::make('')
                    ->description("Ini digunakan agar pengguna memahami bahwa menu ini berfungsi untuk mengarahkan ke halaman terkait ketika menu di halaman utama (home) diklik.")
                    ->schema([
                        Select::make('menu_id')
                            ->label('Menu Halaman')
                            ->options(fn() => static::getHierarchicalCategories())
                            ->required()
                            ->native(false)
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name'),
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
                            ])
                            ->createOptionUsing(function (array $data): string {
                                // Simpan menu baru dan kembalikan ID-nya agar otomatis terpilih
                                $menu = Menu::create([
                                    'name' => $data['name'],
                                    'slug' => Str::slug($data['name']),
                                    'parent_id' => $data['parent_id'] ?? 0,
                                    'url' => null,
                                    'submenu' => $data['submenu'] ?? false,
                                    'number' => Menu::generateMenuNumber($data['parent_id']),
                                    'status' => $data['status'] ?? true,
                                ]);

                                return (string) $menu->id;
                            })
                            ->hint('Jika menu belum ada, klik + untuk menambah baru'),
                    ]),
                TinyEditor::make('content')
                    ->label('Content Page')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('page/images')
                    ->profile('default|simple|full|minimal|none|custom')
                    ->resize('both')
                    ->columnSpan('full')
                    ->required(),
                Section::make('Upload File')
                    ->description('Unggah lampiran file untuk halaman ini')
                    ->schema([
                        TextInput::make('filename')->label('Keterangan File'),
                        Forms\Components\FileUpload::make('file')
                            ->label('Unggah File (.doc, .docx, .pdf, .ppt, .pptx)')
                            ->directory('page/files')
                            ->disk('public')
                            ->multiple()
                            ->visibility('public')
                            ->preserveFilenames()
                            ->maxSize(10240)
                            ->downloadable(true)
                            ->acceptedFileTypes(['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/pdf', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'])
                            ->helperText('Ukuran file maksimum: 10MB'),
                    ]),
                Toggle::make('status')->label('is Published ?')->default(true)
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                BooleanColumn::make('status')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // Tables\Actions\Action::make('detail')
                //     ->url(fn($record) => self::getUrl('detail', ['record' => $record]))
                //     ->icon('heroicon-o-eye'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
            // 'detail' => Pages\DetailPage::route('/{record}/detail'),
        ];
    }




    public static function getHierarchicalCategories(): array
    {
        $categories = \App\Models\Menu::orderBy('name')->get();
        $hierarchical = [];

        $buildTree = function ($parentId = null, $prefix = '') use ($categories, &$buildTree, &$hierarchical) {
            $items = $categories->where('parent_id', $parentId)->sortBy('name');

            foreach ($items as $item) {
                $hierarchical[$item->id] = $prefix . $item->name;
                $buildTree($item->id, $prefix . '-- ');
            }
        };

        $buildTree();

        return $hierarchical;
    }
}
