<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class DetailGallery extends Component
{
    public $gallery;
    public $imagesPerPage = 12;

    public function mount($slug)
    {
        $this->gallery = Gallery::with('category')->where('slug', $slug)->first();
    }

    public function render()
    {
        $images = $this->gallery ? $this->gallery->images()->paginate($this->imagesPerPage) : collect([]);

        return view('livewire.detail-gallery', [
            'images' => $images,
        ])->layout('components.modern-layout', [
            'title' => $this->gallery ? $this->gallery->title : 'Galeri',
            'description' => ($this->gallery ? $this->gallery->title . ' - ' : '') . 'Dokumentasi foto kegiatan ' . company()->name,
            'tags' => 'Galeri, Foto, ' . ($this->gallery ? $this->gallery->title . ', ' : '') . company()->name,
            'author' => company()->name,
            'type' => 'website',
            'image' => $this->gallery && $this->gallery->images()->first() ? $this->gallery->images()->first()->image : asset('assets/images/icon/android-icon-192x192.png'),
            'url' => url()->current(),
        ]);
    }
}
