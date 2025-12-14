<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class GalleryItems extends Component
{
    public $items = [];

    public function mount()
    {
        $this->items = Gallery::with(['images', 'category'])->get()->toArray();
    }

    public function render()
    {
        return view('livewire.gallery-items')
            ->layout('components.modern-layout', [
                'title' => 'Galeri Foto',
                'description' => 'Dokumentasi kegiatan dan fasilitas ' . company()->name,
                'tags' => 'Galeri, Foto, Dokumentasi, Kegiatan, ' . company()->name,
                'author' => company()->name,
                'type' => 'website',
                'image' => asset('assets/images/icon/android-icon-192x192.png'),
                'url' => url()->current(),
            ]);
    }
}
