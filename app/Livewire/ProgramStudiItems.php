<?php

namespace App\Livewire;

use App\Models\ProgramStudi;
use Livewire\Component;

class ProgramStudiItems extends Component
{
    public $items = [];

    public function mount()
    {
        $this->items = ProgramStudi::where('status', true)
            ->orderBy('order')
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.program-studi-items')
            ->layout('components.modern-layout', [
                'title' => 'Program Studi',
                'description' => 'Daftar program studi ' . company()->name,
                'tags' => 'Program Studi, Prodi, ' . company()->name,
                'author' => company()->name,
                'type' => 'website',
                'image' => asset('assets/images/icon/android-icon-192x192.png'),
                'url' => url()->current(),
            ]);
    }
}
