<?php

namespace App\Console\Commands;

use App\Models\Menu;
use App\Models\Page;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class UpdateAboutContent extends Command
{
    protected $signature = 'seed:about-content';

    protected $description = 'Add the "Sambutan Ketua" page and refresh "Tentang Kami" with real STIE Kasih Bangsa content';

    protected const PHOTO_URL = 'https://stiekasihbangsa.ac.id/wp-content/uploads/elementor/thumbs/IMG_0038-scaled-r0irfg9kf92c7hctd6qyawp8u779txaikbidje6xdg.jpg';

    protected const TENTANG_KAMI_CONTENT = '<p>Sebagai salah satu Perguruan Tinggi swasta di Jakarta, Sekolah Tinggi Ilmu Ekonomi Kasih Bangsa (STIE Kasih Bangsa) memiliki visi untuk menjadi Sekolah Tinggi Ilmu Ekonomi Unggulan di tingkat Nasional dan menghasilkan lulusan yang profesional, unggul dan terpercaya. Dengan dukungan dari dosen, tenaga kependidikan dan mitra kerjasama baik dari instansi dalam dan luar negeri, terbukti telah menghasilkan lulusan STIE Kasih Bangsa yang mampu berdaya saing di dunia usaha dunia industri.</p><p>STIE Kasih Bangsa hadir memberikan warna unik pada dunia pendidikan di Indonesia melalui pembangunan karakter manusia unggul, profesional dan terpercaya, program-program yang mumpuni pada pembentukan ide kreatif enterpreneur ataupun intrapreneur melalui komunitas serta standar pelayanan dan standar informasi yang unggul.</p>';

    protected const SAMBUTAN_KETUA_BODY = '<p>Salam Sejahtera Bagi Kita Semua,<br>Sebagai salah satu Perguruan Tinggi swasta di Jakarta, Sekolah Tinggi Ilmu Ekonomi Kasih Bangsa (STIE Kasih Bangsa) memiliki visi untuk menjadi Sekolah Tinggi Ilmu Ekonomi Unggulan di tingkat Nasional dan menghasilkan lulusan yang profesional, unggul dan terpercaya. Dengan dukungan dari dosen, tenaga kependidikan dan mitra kerjasama baik dari instansi dalam dan luar negeri, terbukti telah menghasilkan lulusan STIE Kasih Bangsa yang mampu berdaya saing di dunia usaha dunia industri. Semangat untuk berbuat kebaikan tanpa batas dan menumbuhkembangkan jiwa melayani yang dicetuskan oleh Pendiri Kampus STIE Kasih Bangsa yang telah menuntun dan mengawal mahasiswa serta alumni STIE Kasih Bangsa menjadi seorang pembelajar yang terus menerus meningkatkan kualitas hidup dengan melanjutkan pendidikan ke jenjang S-2/pendidikan profesi secara mandiri. Dengan program beasiswa dan kegiatan non akademik yang dijalankan dikampus STIE Kasih Bangsa, juga telah membentuk mahasiswa untuk mengejar prestasi dan memahami serta mengamalkan nilai-nilai Pancasila dalam kehidupan bermasyarakat, berbangsa dan bernegara.</p><p>Melanjutkan pengabdian dan program Ketua STIE Kasih Bangsa periode terdahulu serta kualitas alumni STIE Kasih Bangsa telah mengukir karirnya sampai saat ini, maka kami yakin setiap lulusan STIE Kasih Bangsa dimasa depan akan mengikuti jejak kesuksesan alumni sebelumnya yang mampu bersaing dan mengikuti perkembangan dunia bisnis melalui doa dan usaha dari seluruh civitas akademik STIE Kasih Bangsa.</p><p>STIE Kasih Bangsa hadir memberikan warna unik pada dunia pendidikan di Indonesia melalui pembangunan karakter manusia unggul, profesional dan terpercaya, program – program yang mumpuni pada pembentukan ide kreatif enterpreneur ataupun intrapreneur rasa enterpreneur melalui komunitas serta standar pelayanan dan standar informasi yang unggul. Kepedulian kami untuk terus memberikan kontribusi positif pada dunia pendidikan semata untuk kebermanfaatan masyarakat Indonesia secara menyeluruh.</p><p style="text-align: justify"><strong><em>Ruslaini, S.E., M.M., CIQaR.</em></strong><br><em>Ketua STIE Kasih Bangsa</em></p>';

    public function handle(): int
    {
        $adminId = User::where('email', 'admin@stpdianmandala.local')->value('id')
            ?? User::query()->value('id');

        // 1. Refresh "Tentang Kami" with accurate, non-fabricated content.
        $tentangKami = Page::where('slug', 'tentang-kami')->first();
        if ($tentangKami) {
            $tentangKami->content = self::TENTANG_KAMI_CONTENT;
            $tentangKami->save();
            $this->info('Updated: Tentang Kami');
        }

        // 2. Create "Sambutan Ketua" page with a mirrored photo.
        $photoPath = $this->mirrorPhoto(self::PHOTO_URL);
        $photoTag = $photoPath ? '<figure><img src="'.asset('storage/'.$photoPath).'" alt="Sambutan Ketua"></figure>' : '';

        $sambutan = Page::firstOrNew(['slug' => 'sambutan-ketua']);
        $sambutan->title = 'Sambutan Ketua';
        $sambutan->content = $photoTag.self::SAMBUTAN_KETUA_BODY;
        $sambutan->status = true;
        $sambutan->created_by = $sambutan->created_by ?: $adminId;
        $sambutan->save();
        $this->info('OK: Sambutan Ketua page');

        // 3. Menu entries under PROFILE.
        $profileMenu = Menu::where('name', 'PROFILE')->where('parent_id', 0)->first();

        if ($profileMenu) {
            $sambutanMenu = Menu::firstOrNew([
                'name' => 'Sambutan Ketua',
                'parent_id' => $profileMenu->id,
            ]);
            $sambutanMenu->slug = $sambutanMenu->slug ?: Str::slug('Sambutan Ketua');
            $sambutanMenu->url = '/page/sambutan-ketua';
            $sambutanMenu->category = 'home';
            $sambutanMenu->status = true;
            if (! $sambutanMenu->exists) {
                $sambutanMenu->number = Menu::generateMenuNumber($profileMenu->id);
            }
            $sambutanMenu->save();
            $this->info('OK: menu Sambutan Ketua');

            $dosenMenu = Menu::firstOrNew([
                'name' => 'Dosen',
                'parent_id' => $profileMenu->id,
            ]);
            $dosenMenu->slug = $dosenMenu->slug ?: Str::slug('Dosen');
            $dosenMenu->url = '/dosen';
            $dosenMenu->category = 'home';
            $dosenMenu->status = true;
            if (! $dosenMenu->exists) {
                $dosenMenu->number = Menu::generateMenuNumber($profileMenu->id);
            }
            $dosenMenu->save();
            $this->info('OK: menu Dosen');
        }

        $this->info('Done.');

        return self::SUCCESS;
    }

    protected function mirrorPhoto(string $sourceUrl): ?string
    {
        $path = 'page/images/sambutan-ketua.jpg';
        $fullPath = Storage::disk('public')->path($path);
        Storage::disk('public')->makeDirectory('page/images');

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
