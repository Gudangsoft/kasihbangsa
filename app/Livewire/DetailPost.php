<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class DetailPost extends Component
{
    public $post;
    public $slug;
    public $title, $tagsString;

    public function mount()
    {
        $this->slug = request()->query('t'); // Ambil parameter dari query string
        if ($this->slug) {
            $this->post = Post::where('slug', $this->slug)->firstOrFail();

            $this->title = $this->post->title;
            $tagsArray = json_encode($this->post->tags, true);
            $this->tagsString = explode(", ", $tagsArray);
            // dd($this->tagsString);
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
        $keywords = is_array($this->post->tags)
            ? implode(', ', $this->post->tags)
            : ($this->post->tags ?? '');

        return view('livewire.detail-post')
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
