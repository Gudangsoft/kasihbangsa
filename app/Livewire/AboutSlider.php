<?php

namespace App\Livewire;

use App\Models\Banner;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class AboutSlider extends Component
{
    public $slides = [];

    public function mount()
    {
        $this->slides = Cache::rememberForever('about_slider_slides', function () {
            return Banner::where('status', true)
                ->where('placement', 'about')
                ->orderBy('id')
                ->limit(6)
                ->get()
                ->toArray();
        });
    }

    public function render()
    {
        return view('livewire.about-slider');
    }
}
