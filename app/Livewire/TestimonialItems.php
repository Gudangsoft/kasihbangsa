<?php

namespace App\Livewire;

use App\Models\Testimonial;
use Livewire\Component;

class TestimonialItems extends Component
{
    public $items;

    public function mount()
    {
        $this->items = Testimonial::where('status', true)->limit(4)->orderByDesc('id')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.testimonial-items');
    }
}
