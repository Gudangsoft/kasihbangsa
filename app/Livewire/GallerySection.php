<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class GallerySection extends Component
{
    public $items = [];

    public function mount()
    {
        $this->items = Gallery::with(['images', 'category'])
            ->latest()
            ->limit(6)
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.gallery-section');
    }
}
