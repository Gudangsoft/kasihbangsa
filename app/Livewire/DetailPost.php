<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class DetailPost extends Component
{
    public $post;
    public $slug;
    public $title, $tagsString;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->post = Post::where('slug', $this->slug)->where('status', true)->firstOrFail();

        $this->title = $this->post->title;

        // Safely handle tags
        if ($this->post->tags) {
            // Check if tags is already an array or needs to be decoded
            if (is_array($this->post->tags)) {
                $this->tagsString = $this->post->tags;
            } elseif (is_string($this->post->tags)) {
                $tagsArray = json_decode($this->post->tags, true);
                $this->tagsString = is_array($tagsArray) ? $tagsArray : explode(", ", $this->post->tags);
            } else {
                $this->tagsString = [];
            }
        } else {
            $this->tagsString = [];
        }
    }

    public function render()
    {
        // Ambil konten text untuk description (strip HTML tags, max 160 karakter)
        $contentText = strip_tags($this->post->content ?? '');
        $description = strlen($contentText) > 160
            ? substr($contentText, 0, 157) . '...'
            : $contentText;

        // Gabungkan tags untuk keywords
        $keywords = '';
        if ($this->post->tags) {
            $keywords = is_array($this->post->tags)
                ? implode(', ', $this->post->tags)
                : (is_string($this->post->tags) ? $this->post->tags : '');
        }

        // Ambil berita terkait dengan kategori yang sama
        $relatedPosts = Post::where('category_id', $this->post->category_id)
            ->where('id', '!=', $this->post->id)
            ->where('status', true)
            ->with('category', 'user')
            ->latest()
            ->limit(3)
            ->get();

        return view('livewire.detail-post', [
            'relatedPosts' => $relatedPosts
        ])
            ->layout('components.modern-layout', [
                'title' => $this->post->title ?? 'Berita',
                'description' => $description ?: ($this->post->preview ?? $this->post->title),
                'tags' => $keywords . ', ' . company()->name . ', Berita, Informasi',
                'author' => $this->post->user->name ?? company()->name,
                'type' => 'article',
                'image' => $this->post->thumbnail ?? asset('assets/images/icon/android-icon-192x192.png'),
                'url' => url()->current(),
            ]);
    }
}
