<?php

namespace App\Livewire;

use App\Models\Banner;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SliderHome extends Component
{
    public $slides = [];

    public function mount()
    {
        $this->slides = Cache::rememberForever('slider_home_slides', function () {
            return Banner::with('getAdd')
                ->where('status', true)
                ->limit(4)
                ->get()
                ->toArray();
        });
    }

    public function render()
    {
        // dd($this->slides);
        return view('livewire.slider-home');
    }
}
