<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Livewire\WithPagination;

class PostItems extends Component
{
    use WithPagination;

    public $categorySlug;
    public $categoryName;
    public $tag;

    protected $queryString = ['categorySlug' => ['except' => '']];

    public function mount()
    {
        $this->categorySlug = request()->query('c');
        $this->tag = request()->query('tag');

        if ($this->categorySlug) {
            $category = PostCategory::where('slug', $this->categorySlug)->first();
            $this->categoryName = $category ? $category->name : null;
        }
    }

    public function render()
    {
        $query = Post::with(['category:id,name,slug', 'user:id,name,username'])
            ->where('status', true);

        if ($this->categorySlug) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->categorySlug);
            });
        }

        if ($this->tag) {
            $query->whereJsonContains('tags', $this->tag);
        }

        $posts = $query->orderByDesc('publish_at')
            ->paginate(6)
            ->through(function ($post) {
                $post->description = $post->contentPreview(20);
                $post->month = $post->date('M');
                $post->day = $post->date('d');
                $post->year = $post->date('Y');
                return $post;
            });

        return view('livewire.post-items', [
            'posts' => $posts,
            'categoryName' => $this->categoryName
        ])->layout('components.modern-layout', [
            'title' => 'Berita & Informasi - ' . company()->name,
            'description' => 'Berita dan informasi terkini seputar STP Dian Mandala Gunung Sitoli Nias',
            'tags' => 'berita, informasi, kampus, ' . company()->name,
            'author' => company()->name,
            'type' => 'website',
            'image' => asset('assets/images/icon/android-icon-192x192.png'),
            'url' => url()->current(),
        ]);
    }
}
