<?php

namespace App\Livewire;

use App\Models\QuickLink;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class QuickLinks extends Component
{
    public $links = [];

    public function mount()
    {
        $this->links = Cache::rememberForever('home_quick_links', function () {
            return QuickLink::where('status', true)
                ->orderBy('number')
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.quick-links');
    }
}
