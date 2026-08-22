<?php

namespace App\Console\Commands;

use App\Models\Banner;
use App\Models\CompanyProfile;
use App\Models\GalleryCategory;
use App\Models\HomeSetting;
use App\Models\InformationCategory;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Testimonial;
use Illuminate\Console\Command;

class CleanupOldBrandContent extends Command
{
    protected $signature = 'cleanup:old-brand';

    protected $description = 'Remove/replace leftover "STP Dian Mandala" branding and dead links from the previous institution';

    protected const REAL_ADDRESS = 'JL. Dr. Kasih No. 1, Arteri Kebon Jeruk, Jakarta Barat 11530';

    protected const REAL_EMAIL = 'stie.kasihbangsa@gmail.com';

    protected const REAL_WEBSITE = 'https://www.stiekasihbangsa.ac.id';

    protected const REAL_DESC = 'Sebagai salah satu Perguruan Tinggi swasta di Jakarta, Sekolah Tinggi Ilmu Ekonomi Kasih Bangsa (STIE Kasih Bangsa) memiliki visi untuk menjadi Sekolah Tinggi Ilmu Ekonomi Unggulan di tingkat Nasional dan menghasilkan lulusan yang profesional, unggul dan terpercaya.';

    protected const REAL_PMB_URL = 'https://stiekasihbangsa.sevimaplatform.com/spmbfront/jalur-seleksi';

    protected const PLACEHOLDER = '<p>Konten sedang disiapkan oleh admin. Silakan cek kembali dalam waktu dekat.</p>';

    public function handle(): int
    {
        // 1. Company profile (legacy standalone model) — align with the real institution.
        if ($cp = CompanyProfile::first()) {
            $cp->name = 'STIE Kasih Bangsa';
            $cp->description = self::REAL_DESC;
            $cp->address = self::REAL_ADDRESS;
            $cp->email = self::REAL_EMAIL;
            $cp->website = self::REAL_WEBSITE;
            $cp->save();
            $this->info('OK: company_profiles');
        }

        // 2. home_settings.company_website was still the old domain.
        if ($hs = HomeSetting::first()) {
            $hs->company_website = self::REAL_WEBSITE;
            $hs->save();
            $this->info('OK: home_settings.company_website');
        }

        // 3. Category descriptions.
        InformationCategory::where('id', 1)->update(['description' => 'Informasi tentang akademik STIE Kasih Bangsa']);
        GalleryCategory::where('id', 1)->update(['description' => 'Foto kegiatan SEMA STIE Kasih Bangsa']);
        $this->info('OK: category descriptions');

        // 4. Banners: fix the real STIE banner's stale metadata, drop the fully dead one.
        if ($b1 = Banner::find(1)) {
            $b1->title = 'Welcome to STIE Kasih Bangsa';
            $b1->url = self::REAL_PMB_URL;
            $b1->save();
            $this->info('OK: banner #1 metadata');
        }
        if ($b2 = Banner::find(2)) {
            $b2->delete();
            $this->info('Deleted: banner #2 (dead image, fully old-branded)');
        }

        // 5. Menus.
        if ($pmb = Menu::where('name', 'PMB')->where('parent_id', 0)->first()) {
            $pmb->url = self::REAL_PMB_URL;
            $pmb->save();
            $this->info('OK: menu PMB -> real Sevima link');
        }

        // PKK is a study program that only existed at the old institution.
        Menu::where('name', 'Pendidikan Keagamaan Katolik (PKK)')->delete();
        $this->info('Deleted: menu Pendidikan Keagamaan Katolik (PKK) — program does not exist at STIE');

        // Repoint the academic calendar link to the real, already-imported document.
        if ($kalender = Menu::where('name', 'Kalender Akademik')->first()) {
            $kalender->url = '/informasi/kalender-akademik-2026';
            $kalender->save();
            $this->info('OK: menu Kalender Akademik -> local document');
        }

        // LPM / P3M external links point to the old institution's subdomains and
        // have no confirmed STIE equivalent — deactivate rather than guess a URL.
        $deactivated = Menu::whereIn('name', ['Dokumen Mutu', 'P3M'])
            ->where(function ($q) {
                $q->where('url', 'like', '%stpdianmandala%')
                    ->orWhere('url', 'like', '%stpdianmanadala%');
            })
            ->update(['status' => false]);
        $this->info("Deactivated: {$deactivated} menu item(s) with unverified old-institution links (Dokumen Mutu / P3M)");

        // 6. Testimonials belong to real named alumni of the previous institution —
        // not transferable to STIE, so deactivate rather than rewrite or delete.
        $deactivatedTestimonials = Testimonial::query()->update(['status' => false]);
        $this->info("Deactivated: {$deactivatedTestimonials} testimonial(s) (STP Dian Mandala alumni, not applicable to STIE)");

        // 7. Pages with no real STIE source content — replace wrong info with an
        // honest placeholder instead of leaving false claims about a different
        // institution's history/vision/structure live on the site.
        $placeholderSlugs = ['visi-dan-misi', 'sejarah-sekolah-tinggi', 'fungsionaris-prodi-lpm-p3m', 'kepengurusan-sema-ta-20242025'];
        foreach ($placeholderSlugs as $slug) {
            if ($page = Page::where('slug', $slug)->first()) {
                $page->content = self::PLACEHOLDER;
                $page->save();
                $this->info("OK: placeholder for page '{$slug}'");
            }
        }

        $this->info('Done.');

        return self::SUCCESS;
    }
}
