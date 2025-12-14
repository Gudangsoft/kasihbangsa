<?php

use App\Http\Controllers\TiktokController;
use App\Http\Controllers\UserController;
use App\Livewire\DetailGallery;
use App\Livewire\DetailPage;
use App\Livewire\DetailPost;
use App\Livewire\GalleryItems;
use App\Livewire\GlobalSearch;
use App\Livewire\InformationItems;
use App\Livewire\InformationList;
use App\Livewire\KerjaSama;
use App\Livewire\PostItems;
use App\Livewire\TestimonialList;
use App\Models\Page;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home-new');
});

Route::get('/search', GlobalSearch::class)->name('search');
Route::get('berita', PostItems::class)->name('berita');
Route::get('read', DetailPost::class)->name('detail-berita');

Route::get('/page/{slug}', DetailPage::class)->name('detail-page');
Route::get('/informasi', InformationItems::class)->name('informasi');
Route::get('/informasi/{slug}', InformationList::class)->name('information-list');
Route::get('gallery', GalleryItems::class)->name('galleries');
Route::get('gallery/{slug}', DetailGallery::class)->name('detail-gallery');
Route::get('/kerjasama', KerjaSama::class)->name('kerjasama');
Route::get('/testimoni', TestimonialList::class)->name('testimoni');
// });


