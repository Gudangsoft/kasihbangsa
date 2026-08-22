<?php

namespace App\Console\Commands;

use App\Models\Dosen;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SeedDosenProfiles extends Command
{
    protected $signature = 'seed:dosen-profiles';

    protected $description = 'Import lecturer profiles scraped from stiekasihbangsa.ac.id into the dosens table';

    public function handle(): int
    {
        $path = database_path('seeders/data/dosen-stie-kasih-bangsa.json');

        if (! file_exists($path)) {
            $this->error("Data file not found: {$path}");

            return self::FAILURE;
        }

        $rows = json_decode(file_get_contents($path), true);

        foreach ($rows as $index => $row) {
            $fields = $row['fields'] ?? [];
            $sections = $row['sections'] ?? [];

            $nidn = $this->pick($fields, ['Nidn', 'NIDN']);
            $prodi = $this->pick($fields, ['Program Studi', 'Unit Kerja']);
            $jabatanAkademik = $this->pick($fields, ['Jab. Akademik']);
            $jabatanInstitusi = $this->pick($fields, ['Jab. Institusi']);
            $statusDosen = $this->pick($fields, ['Status Dosen', 'Status Dose']);
            $sertifikasi = $this->pick($fields, ['Sertifikasi Dosen']);

            $riwayat = $this->pick($sections, ['Riwayat Pendidikan', 'Riwaya Pendidikan']);
            $penelitian = $this->pick($sections, ['Penelitian']);
            $pengabdian = $this->pick($sections, ['Pengabdian Masyarakat']);
            $capaian = $this->pick($sections, ['Capaian Khusus', 'Raihan Khusus']);

            $slug = Str::slug($row['name']);

            $dosen = Dosen::firstOrNew(['slug' => $slug]);
            $dosen->name = $row['name'];
            $dosen->nidn = $nidn && $nidn !== '–' ? $nidn : null;
            $dosen->prodi = $prodi && $prodi !== '–' ? $prodi : null;
            $dosen->jabatan_akademik = $jabatanAkademik;
            $dosen->jabatan_institusi = $jabatanInstitusi;
            $dosen->status_dosen = $statusDosen;
            $dosen->sertifikasi_dosen = $sertifikasi;
            $dosen->riwayat_pendidikan = $riwayat ?: null;
            $dosen->penelitian = $penelitian ?: null;
            $dosen->pengabdian_masyarakat = $pengabdian ?: null;
            $dosen->capaian_khusus = $capaian ?: null;
            $dosen->order = $index;
            $dosen->status = true;
            $dosen->save();

            $this->info("OK: {$row['name']}");
        }

        $this->info('Done.');

        return self::SUCCESS;
    }

    protected function pick(array $data, array $keys)
    {
        foreach ($keys as $key) {
            if (! empty($data[$key])) {
                return $data[$key];
            }
        }

        return null;
    }
}
