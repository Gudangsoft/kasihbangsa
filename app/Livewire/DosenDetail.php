<?php

namespace App\Livewire;

use App\Models\Dosen;
use Livewire\Component;

class DosenDetail extends Component
{
    public $dosen;

    public function mount($slug)
    {
        $this->dosen = Dosen::where('slug', $slug)->where('status', true)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.dosen-detail')
            ->layout('components.modern-layout', [
                'title' => $this->dosen->name,
                'description' => 'Profil ' . $this->dosen->name . ' - ' . company()->name,
                'tags' => 'Dosen, ' . $this->dosen->name . ', ' . company()->name,
                'author' => company()->name,
                'type' => 'website',
                'image' => $this->dosen->photo_url,
                'url' => url()->current(),
            ]);
    }
}
