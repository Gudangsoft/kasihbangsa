<?php

namespace App\Livewire;

use App\Models\Dosen;
use Livewire\Component;

class DosenItems extends Component
{
    public $items = [];

    public function mount()
    {
        $this->items = Dosen::where('status', true)
            ->orderBy('order')
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.dosen-items')
            ->layout('components.modern-layout', [
                'title' => 'Profil Dosen',
                'description' => 'Daftar dosen ' . company()->name,
                'tags' => 'Dosen, Profil Dosen, ' . company()->name,
                'author' => company()->name,
                'type' => 'website',
                'image' => asset('assets/images/icon/android-icon-192x192.png'),
                'url' => url()->current(),
            ]);
    }
}
