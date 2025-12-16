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
    protected static ?string $navigationLabel = 'Halaman';

    protected static ?string $modelLabel = 'Halaman';
    protected static ?string $pluralModelLabel = 'Halaman';

    // protected static ?string $navigationGroup = 'Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('📋 Panduan Penggunaan Menu Halaman')
                    ->description('Menu Halaman berfungsi untuk membuat halaman konten yang dapat diakses melalui menu navigasi di website. Setiap halaman yang dibuat akan terhubung dengan menu yang dipilih.')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        Forms\Components\Placeholder::make('panduan')
                            ->label('')
                            ->content(new \Illuminate\Support\HtmlString('
                                <div class="space-y-3 text-sm">
                                    <div class="bg-blue-50 border-l-4 border-blue-400 p-3 rounded">
                                        <p class="font-semibold text-blue-800 mb-2">📌 Langkah-langkah Membuat Halaman:</p>
                                        <ol class="list-decimal ml-5 space-y-1 text-blue-700">
                                            <li>Isi <strong>Judul Halaman</strong> sesuai konten yang akan dibuat</li>
                                            <li>Pilih <strong>Menu Halaman</strong> yang sudah ada atau buat menu baru dengan klik tombol +</li>
                                            <li>Isi <strong>Konten</strong> halaman menggunakan editor TinyMCE</li>
                                            <li>Upload file pendukung jika diperlukan (opsional)</li>
                                            <li>Pastikan status <strong>Published</strong> aktif agar halaman dapat dilihat di website</li>
                                        </ol>
                                    </div>

                                    <div class="bg-green-50 border-l-4 border-green-400 p-3 rounded">
                                        <p class="font-semibold text-green-800 mb-2">✅ Cara Kerja Menu Halaman:</p>
                                        <ul class="list-disc ml-5 space-y-1 text-green-700">
                                            <li>Ketika pengguna mengklik menu di navigasi website, sistem akan menampilkan halaman yang terhubung dengan menu tersebut</li>
                                            <li>Satu menu dapat memiliki satu halaman konten</li>
                                            <li>Jika menu belum tersedia, Anda dapat membuat menu baru langsung dari form ini</li>
                                        </ul>
                                    </div>

                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                                        <p class="font-semibold text-yellow-800 mb-2">💡 Tips:</p>
                                        <ul class="list-disc ml-5 space-y-1 text-yellow-700">
                                            <li>Gunakan judul yang jelas dan deskriptif</li>
                                            <li>Pastikan konten mudah dibaca dan informatif</li>
                                            <li>Upload file pendukung seperti PDF atau dokumen jika diperlukan</li>
                                            <li>Preview halaman di website setelah menyimpan</li>
                                        </ul>
                                    </div>
                                </div>
                            ')),
                    ]),
                Section::make('Informasi Halaman')->schema([
                    TextInput::make('title')
                        ->label('Judul Halaman')
                        ->placeholder('Contoh: Tentang Kami, Visi Misi, Struktur Organisasi')
                        ->helperText('Masukkan judul halaman yang akan ditampilkan di website')
                        ->required(),
                ]),
                Section::make('Pengaturan Menu')
                    ->description("Pilih menu yang akan mengarahkan ke halaman ini. Ketika menu diklik di website, halaman ini akan ditampilkan.")
                    ->schema([
                        Select::make('menu_id')
                            ->label('Menu Halaman')
                            ->placeholder('Pilih menu yang sudah ada')
                            ->options(fn() => static::getHierarchicalCategories())
                            ->required()
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->helperText('Pilih menu yang akan mengarah ke halaman ini, atau klik tombol + untuk membuat menu baru')
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
                Section::make('Konten Halaman')
                    ->description('Gunakan editor untuk membuat konten halaman. Anda dapat menambahkan teks, gambar, tabel, dan format lainnya.')
                    ->schema([
                        TinyEditor::make('content')
                            ->label('Isi Konten')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('page/images')
                            ->profile('default|simple|full|minimal|none|custom')
                            ->resize('both')
                            ->columnSpan('full')
                            ->required()
                            ->helperText('Gunakan toolbar untuk memformat teks dan menambahkan media'),
                    ]),
                Section::make('Upload File')
                    ->description('Unggah file pendukung seperti dokumen, PDF, atau presentasi yang terkait dengan halaman ini (opsional)')
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextInput::make('filename')
                            ->label('Keterangan File')
                            ->placeholder('Contoh: Dokumen Laporan Tahunan 2024')
                            ->helperText('Berikan keterangan singkat tentang file yang diupload'),
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
                            ->helperText('Format yang didukung: DOC, DOCX, PDF, PPT, PPTX. Maksimal: 10MB per file'),
                    ]),
                Section::make('Status Publikasi')
                    ->description('Aktifkan untuk menampilkan halaman di website, nonaktifkan untuk menyembunyikan')
                    ->schema([
                        Toggle::make('status')
                            ->label('Publikasikan Halaman')
                            ->helperText('Hanya halaman dengan status aktif yang akan ditampilkan di website')
                            ->default(true),
                    ]),
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
