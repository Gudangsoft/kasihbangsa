<?php

namespace App\Livewire;

use App\Models\ProgramStudi;
use Livewire\Component;

class ProgramStudiDetail extends Component
{
    public $prodi;

    public function mount($slug)
    {
        $this->prodi = ProgramStudi::where('slug', $slug)->where('status', true)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.program-studi-detail', [
            'dosens' => $this->prodi->dosens(),
        ])->layout('components.modern-layout', [
            'title' => $this->prodi->name,
            'description' => $this->prodi->description ?: ($this->prodi->name . ' - ' . company()->name),
            'tags' => 'Program Studi, ' . $this->prodi->name . ', ' . company()->name,
            'author' => company()->name,
            'type' => 'website',
            'image' => $this->prodi->image_url,
            'url' => url()->current(),
        ]);
    }
}
