<?php

namespace App\Livewire;

use App\Models\KerjaSama as ModelsKerjaSama;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class KerjaSama extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';
    public $lembaga = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedLembaga()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ModelsKerjaSama::where('status', true)
            ->when($this->search, function ($query) {
                $query->where('kode', 'LIKE', "%{$this->search}%");
            })
            ->when($this->lembaga, function ($query) {
                $query->where('lembaga_mitra', 'LIKE', "%{$this->lembaga}%");
            });

        $count = $query->count(); // Hitung total hasil pencarian
        $data = $query->paginate(15);

        return view('livewire.kerja-sama', compact('data', 'count'))
            ->layout('components.modern-layout', [
                'title' => 'Kerja Sama',
                'description' => 'Daftar kerja sama ' . company()->name . ' dengan berbagai institusi dan lembaga',
                'tags' => 'Kerja Sama, Partnership, Kolaborasi, ' . company()->name,
                'author' => company()->name,
                'type' => 'website',
                'image' => asset('assets/images/icon/android-icon-192x192.png'),
                'url' => url()->current(),
            ]);
    }
}
