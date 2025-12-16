<?php

namespace App\Livewire;

use App\Models\Information;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Page;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.modern-layout')]
#[Title('Pencarian')]
class GlobalSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $type = 'all'; // all, information, news, gallery, page

    protected $queryString = [
        'search' => ['except' => ''],
        'type' => ['except' => 'all'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingType()
    {
        $this->resetPage();
    }

    public function render()
    {
        $results = collect();
        $informations = collect();
        $posts = collect();
        $galleries = collect();
        $pages = collect();

        if (strlen($this->search) >= 3) {
            $searchTerm = '%' . $this->search . '%';

            if ($this->type === 'all' || $this->type === 'information') {
                $informations = Information::where('status', true)
                    ->where(function ($query) use ($searchTerm) {
                        $query->where('title', 'like', $searchTerm)
                            ->orWhere('description', 'like', $searchTerm);
                    })
                    ->with('category')
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(function ($item) {
                        $item->type = 'information';
                        $item->type_label = 'Informasi';
                        $item->url = route('information-list', $item->slug);
                        $item->icon = 'document';
                        return $item;
                    });
            }

            if ($this->type === 'all' || $this->type === 'news') {
                $posts = Post::where('status', true)
                    ->where(function ($query) use ($searchTerm) {
                        $query->where('title', 'like', $searchTerm)
                            ->orWhere('preview', 'like', $searchTerm)
                            ->orWhere('content', 'like', $searchTerm);
                    })
                    ->with('category')
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(function ($item) {
                        $item->type = 'news';
                        $item->type_label = 'Berita';
                        $item->url = route('detail-berita', ['slug' => $item->slug]);
                        $item->icon = 'newspaper';
                        return $item;
                    });
            }

            if ($this->type === 'all' || $this->type === 'gallery') {
                $galleries = Gallery::where(function ($query) use ($searchTerm) {
                        $query->where('title', 'like', $searchTerm)
                            ->orWhere('description', 'like', $searchTerm);
                    })
                    ->with('category')
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(function ($item) {
                        $item->type = 'gallery';
                        $item->type_label = 'Galeri';
                        $item->url = route('detail-gallery', $item->slug);
                        $item->icon = 'photo';
                        return $item;
                    });
            }

            if ($this->type === 'all' || $this->type === 'page') {
                $pages = Page::published()
                    ->where(function ($query) use ($searchTerm) {
                        $query->where('title', 'like', $searchTerm)
                            ->orWhere('content', 'like', $searchTerm);
                    })
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(function ($item) {
                        $item->type = 'page';
                        $item->type_label = 'Halaman';
                        $item->url = route('detail-page', $item->slug);
                        $item->icon = 'page';
                        return $item;
                    });
            }

            // Merge all results
            $results = $informations
                ->merge($posts)
                ->merge($galleries)
                ->merge($pages)
                ->sortByDesc('created_at');
        }

        return view('livewire.global-search', [
            'results' => $results,
            'totalResults' => $results->count(),
            'informationsCount' => $informations->count(),
            'postsCount' => $posts->count(),
            'galleriesCount' => $galleries->count(),
            'pagesCount' => $pages->count(),
        ])->layout('components.modern-layout', [
            'title' => 'Pencarian',
            'description' => 'Cari informasi, berita, galeri, dan halaman di STP Dian Mandala',
            'tags' => 'pencarian, search, informasi, berita, galeri',
            'author' => company()->name,
            'type' => 'website',
            'image' => company()->image,
            'url' => route('search'),
        ]);;
    }
}
