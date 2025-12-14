<?php

namespace App\Livewire;

use App\Models\Information;
use App\Models\InformationCategory;
use Livewire\Component;

class InformationList extends Component
{
    public $title;
    public $items = [];

    public function mount($slug)
    {
        $category = InformationCategory::where('slug', $slug)->where('status', true)->first();
        $this->title = 'Informasi '.ucwords($category->name);
        $this->items = Information::where('category_id', $category->id)->where('status', true)->get()->toArray();
    }

    public function render()
    {
        return view('livewire.information-list')
            ->layout('components.modern-layout', [
                'title' => $this->title ?? 'Informasi',
                'description' => $this->title . ' - ' . company()->name,
                'tags' => 'Informasi, Pengumuman, ' . company()->name,
                'author' => company()->name,
                'type' => 'website',
                'image' => asset('assets/images/icon/android-icon-192x192.png'),
                'url' => url()->current(),
            ]);
    }
}
