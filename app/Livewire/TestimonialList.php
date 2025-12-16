<?php

namespace App\Livewire;

use App\Models\Testimonial;
use Livewire\Component;
use Livewire\WithPagination;

class TestimonialList extends Component
{
    use WithPagination;

    public function render()
    {
        $testimonials = Testimonial::where('status', true)
            ->orderByDesc('id')
            ->paginate(6);

        return view('livewire.testimonial-list', [
            'testimonials' => $testimonials
        ])->layout('components.modern-layout', [
            'title' => 'Testimoni Alumni - ' . company()->name,
            'description' => 'Testimoni dari para alumni STP Dian Mandala yang telah merasakan pendidikan berkualitas',
            'tags' => 'testimoni, alumni, pendidikan, ' . company()->name,
            'author' => company()->name,
            'type' => 'website',
            'image' => asset('assets/images/icon/android-icon-192x192.png'),
            'url' => url()->current(),
        ]);
    }
}
