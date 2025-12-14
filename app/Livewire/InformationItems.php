<?php

namespace App\Livewire;

use App\Models\Information;
use App\Models\InformationCategory;
use Livewire\Component;
use Livewire\WithPagination;

class InformationItems extends Component
{
    use WithPagination;

    public $categorySlug;
    public $categoryName;

    protected $queryString = ['categorySlug' => ['except' => '']];

    public function mount()
    {
        $this->categorySlug = request()->query('c');

        if ($this->categorySlug) {
            $category = InformationCategory::where('slug', $this->categorySlug)->where('status', true)->first();
            $this->categoryName = $category ? $category->name : null;
        }
    }

    public function render()
    {
        $query = Information::with('category:id,name,slug')
            ->where('status', true);

        if ($this->categorySlug) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->categorySlug);
            });
        }

        $informations = $query->orderByDesc('created_at')->paginate(12);

        // Get all categories for filter
        $categories = InformationCategory::where('status', true)->get();

        return view('livewire.information-items', [
            'informations' => $informations,
            'categories' => $categories,
            'categoryName' => $this->categoryName
        ])->layout('components.modern-layout', [
            'title' => ($this->categoryName ? 'Informasi ' . $this->categoryName . ' - ' : 'Informasi - ') . company()->name,
            'description' => 'Informasi dan pengumuman terkini dari STP Dian Mandala Gunung Sitoli Nias',
            'tags' => 'informasi, pengumuman, dokumen, ' . company()->name,
            'author' => company()->name,
            'type' => 'website',
            'image' => asset('assets/images/icon/android-icon-192x192.png'),
            'url' => url()->current(),
        ]);
    }
}
