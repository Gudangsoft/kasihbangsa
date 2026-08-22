<?php

namespace App\Console\Commands;

use App\Models\Information;
use App\Models\InformationCategory;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class SeedAccreditationDocuments extends Command
{
    protected $signature = 'seed:accreditation-documents';

    protected $description = 'Import accreditation certificates and PPKPT policy documents from stiekasihbangsa.ac.id into Informasi';

    /**
     * Hand-picked from the WordPress media library after removing
     * superseded/duplicate/irrelevant uploads (junk filenames, expired
     * announcements, older accreditation cycles). Only the newest version
     * of each document is kept.
     */
    protected array $documents = [
        [
            'category' => 'Akreditasi',
            'title' => 'Sertifikat Akreditasi Institusi STIE Kasih Bangsa (2025)',
            'description' => 'Sertifikat akreditasi institusi terbaru, terbit 18 Desember 2025.',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2026/02/Sertifikat-Akreditasi-STIE-Kasih-Bangsa-18-Des-25.pdf',
        ],
        [
            'category' => 'Akreditasi',
            'title' => 'SK Akreditasi Institusi STIE Kasih Bangsa (s.d. 2025)',
            'description' => 'Surat Keputusan akreditasi institusi.',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2025/11/SK-AKreditasi-STIE-Kasih-bangsa-sd-2025.pdf',
        ],
        [
            'category' => 'Akreditasi',
            'title' => 'Sertifikat Akreditasi Program Studi Akuntansi',
            'description' => 'Sertifikat akreditasi Program Studi Sarjana Akuntansi.',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2025/10/1969-Sertifikat-Akreditasi-Sekolah-Tinggi-Ilmu-Ekonomi-Kasih-Bangsa-Sarjana-Akuntansi-1.pdf',
        ],
        [
            'category' => 'Akreditasi',
            'title' => 'Sertifikat Akreditasi Program Studi Manajemen',
            'description' => 'Sertifikat akreditasi Program Studi Sarjana Manajemen.',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2024/07/1337-Sertifikat-Akreditasi-Sekolah-Tinggi-Ilmu-Ekonomi-Kasih-Bangsa-Sarjana-Manajemen-1.pdf',
        ],
        [
            'category' => 'Mahasiwa',
            'title' => 'Pedoman PPKPT',
            'description' => 'Pedoman Pencegahan dan Penanganan Kekerasan Seksual di Perguruan Tinggi (PPKPT).',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2026/03/Pedoman-PPKPT.pdf',
        ],
        [
            'category' => 'Mahasiwa',
            'title' => 'SK PPKPT',
            'description' => 'Surat Keputusan pembentukan Satuan Tugas PPKPT.',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2026/03/PPKPT-SK.pdf',
        ],
        [
            'category' => 'Mahasiwa',
            'title' => 'SK Panitia Seleksi Satgas PPKPT',
            'description' => 'Surat Keputusan Panitia Seleksi Satuan Tugas PPKPT.',
            'source' => 'https://stiekasihbangsa.ac.id/wp-content/uploads/2026/03/Pansel-SK-PPKS-1.pdf',
        ],
    ];

    protected array $categoryCache = [];

    public function handle(): int
    {
        $adminId = User::where('email', 'admin@stpdianmandala.local')->value('id')
            ?? User::query()->value('id');

        if (! $adminId) {
            $this->error('No user found to assign as document author.');

            return self::FAILURE;
        }

        Storage::disk('public')->makeDirectory('information-files');

        foreach ($this->documents as $doc) {
            $path = $this->mirrorDocument($doc['source'], $doc['title']);

            if (! $path) {
                $this->warn("Skipped '{$doc['title']}': failed to download {$doc['source']}");

                continue;
            }

            $categoryId = $this->resolveCategory($doc['category']);
            $slug = Str::slug($doc['title']);

            $info = Information::firstOrNew(['slug' => $slug]);
            $info->title = $doc['title'];
            $info->description = $doc['description'];
            $info->category_id = $categoryId;
            $info->status = true;
            $info->created_by = $adminId;
            $info->file = $path;
            $info->save();

            $this->info("OK: {$doc['title']}");
        }

        $this->info('Done.');

        return self::SUCCESS;
    }

    protected function resolveCategory(string $name): int
    {
        if (! isset($this->categoryCache[$name])) {
            $category = InformationCategory::firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'status' => true]
            );
            $this->categoryCache[$name] = $category->id;
        }

        return $this->categoryCache[$name];
    }

    protected function mirrorDocument(string $sourceUrl, string $title): ?string
    {
        $filename = Str::slug($title).'.pdf';
        $path = 'information-files/'.$filename;
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

        return $path;
    }
}
