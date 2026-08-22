<?php

namespace App\Console\Commands;

use App\Models\Menu;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SeedPusatDownloadMenu extends Command
{
    protected $signature = 'seed:pusat-download-menu';

    protected $description = 'Create the "Pusat Download" nav menu with document links mirrored from stiekasihbangsa.ac.id';

    /**
     * Real download links taken from the live site's "Pusat Download" menu
     * (https://stiekasihbangsa.ac.id/). PDFs are mirrored to local storage;
     * the MBKM item is kept as an external Google Drive link, same as it
     * is on the source site.
     */
    protected array $documents = [
        [
            'name' => 'FORM SIDANG SKRIPSI',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2021/06/FORM-SIDANG-SKRIPSI.pdf',
            'filename' => 'form-sidang-skripsi.pdf',
        ],
        [
            'name' => 'SYARAT BERKAS LPK 1',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2024/12/003.-CHECK-LIST-LPK-1-1.pdf',
            'filename' => 'syarat-berkas-lpk-1.pdf',
        ],
        [
            'name' => 'SYARAT BERKAS LPK 2',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2024/12/003.-CHECK-LIST-LPK-2-1.pdf',
            'filename' => 'syarat-berkas-lpk-2.pdf',
        ],
        [
            'name' => 'SYARAT BERKAS SIDANG SKRIPSI',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2023/08/003.-CHECK-LIST-SIDANG-SKRIPSI.pdf',
            'filename' => 'syarat-berkas-sidang-skripsi.pdf',
        ],
        [
            'name' => 'BERKAS WISUDA',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2024/03/003.-CHECK-LIST-BERKAS-WISUDA-1.pdf',
            'filename' => 'berkas-wisuda.pdf',
        ],
        [
            'name' => 'MERDEKA BELAJAR KAMPUS MERDEKA',
            'source' => 'https://drive.google.com/file/d/1w5a4k636jQGEXblADzMo4crPfGOwqw8M/view',
            'filename' => null,
        ],
    ];

    public function handle(): int
    {
        $parent = Menu::firstOrCreate(
            ['name' => 'PUSAT DOWNLOAD', 'parent_id' => 0, 'category' => 'home'],
            [
                'slug' => 'pusat-download',
                'url' => '#',
                'submenu' => true,
                'status' => true,
                'number' => Menu::generateMenuNumber(0),
            ]
        );

        Storage::disk('public')->makeDirectory('pusat-download');

        foreach ($this->documents as $doc) {
            $url = $doc['filename']
                ? $this->mirrorDocument($doc['source'], $doc['filename'])
                : $doc['source'];

            if (! $url) {
                $this->warn("Skipped '{$doc['name']}': failed to download {$doc['source']}");

                continue;
            }

            $menu = Menu::firstOrNew([
                'name' => $doc['name'],
                'parent_id' => $parent->id,
            ]);

            $menu->slug = $menu->slug ?: \Illuminate\Support\Str::slug($doc['name']);
            $menu->url = $url;
            $menu->category = 'home';
            $menu->status = true;
            if (! $menu->exists) {
                $menu->number = Menu::generateMenuNumber($parent->id);
            }
            $menu->save();

            $this->info("OK: {$doc['name']} -> {$url}");
        }

        $this->info('Done.');

        return self::SUCCESS;
    }

    protected function mirrorDocument(string $sourceUrl, string $filename): ?string
    {
        $path = 'pusat-download/'.$filename;
        $fullPath = Storage::disk('public')->path($path);

        try {
            $response = Http::timeout(60)->withOptions(['sink' => $fullPath])->retry(2, 500)->get($sourceUrl);
        } catch (Throwable) {
            @unlink($fullPath);

            return null;
        }

        if ($response->failed()) {
            @unlink($fullPath);

            return null;
        }

        return asset('storage/'.$path);
    }
}
