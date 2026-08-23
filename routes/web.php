<?php

use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TiktokController;
use App\Http\Controllers\TinyMceUploadController;
use App\Http\Controllers\UserController;
use App\Livewire\DetailGallery;
use App\Livewire\DetailPage;
use App\Livewire\DetailPost;
use App\Livewire\DosenDetail;
use App\Livewire\DosenItems;
use App\Livewire\GalleryItems;
use App\Livewire\GlobalSearch;
use App\Livewire\InformationItems;
use App\Livewire\InformationList;
use App\Livewire\KerjaSama;
use App\Livewire\PostItems;
use App\Livewire\ProgramStudiDetail;
use App\Livewire\ProgramStudiItems;
use App\Livewire\TestimonialList;
use App\Models\Page;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home-new');
});

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::post('/admin/tinymce-upload', [TinyMceUploadController::class, 'store'])
    ->middleware('auth')
    ->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class])
    ->name('tinymce.upload');

Route::get('/search', GlobalSearch::class)->name('search');
Route::get('/prodi', ProgramStudiItems::class)->name('prodi');
Route::get('/prodi/{slug}', ProgramStudiDetail::class)->name('prodi-detail');
Route::get('berita', PostItems::class)->name('berita');
Route::get('berita/{slug}', DetailPost::class)->name('detail-berita');

Route::get('/page/{slug}', DetailPage::class)->name('detail-page');
Route::get('/informasi', InformationItems::class)->name('informasi');
Route::get('/informasi/{slug}', InformationList::class)->name('information-list');
Route::get('/informasi/download/{id}', function ($id) {
    $information = \App\Models\Information::findOrFail($id);
    $filePath = storage_path('app/public/' . $information->file);

    if (!file_exists($filePath)) {
        abort(404, 'File tidak ditemukan');
    }

    return response()->download($filePath);
})->name('information-download');
Route::get('gallery', GalleryItems::class)->name('galleries');
Route::get('gallery/{slug}', DetailGallery::class)->name('detail-gallery');
Route::get('/dosen', DosenItems::class)->name('dosen');
Route::get('/dosen/{slug}', DosenDetail::class)->name('dosen-detail');
Route::get('/kerjasama', KerjaSama::class)->name('kerjasama');
Route::get('/testimoni', TestimonialList::class)->name('testimoni');
// });


