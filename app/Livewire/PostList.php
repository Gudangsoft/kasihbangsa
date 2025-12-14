<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostList extends Component
{
    public $postItems = [];
    public $limit = 0;

    public function mount()
    {
        $this->postItems = Post::with(['category:id,name,slug', 'user:id,name,username'])
            ->where('status', true)
            ->orderByDesc('publish_at')
            ->limit($this->limit)
            ->get()
            ->map(function ($post) {
                $post->description = $post->contentPreview(20);
                $post->month = $post->date('M');
                $post->day = $post->date('d');
                $post->year = $post->date('Y');
                return $post;
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.post-list')
            ->layout('components.modern-layout', [
                'title' => 'Berita & Informasi',
                'description' => 'Berita terkini dan informasi dari ' . company()->name,
                'tags' => 'Berita, Informasi, Artikel, ' . company()->name,
                'author' => company()->name,
                'type' => 'website',
                'image' => asset('assets/images/icon/android-icon-192x192.png'),
                'url' => url()->current(),
            ]);
    }
}
