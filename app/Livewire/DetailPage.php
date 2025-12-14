<?php

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class DetailPage extends Component
{
    public $page = [];

    public function mount($slug)
    {
        // dd($slug);
        $this->page = Page::where('slug', $slug)->firstOrFail();
        // dd($this->page);
    }

    public function render()
    {
        // Ambil konten text untuk description (strip HTML tags, max 160 karakter)
        $contentText = strip_tags($this->page->content);
        $description = strlen($contentText) > 160
            ? substr($contentText, 0, 157) . '...'
            : $contentText;

        return view('livewire.detail-page')
            ->layout('components.modern-layout', [
                'title' => $this->page->title,
                'description' => $description ?: $this->page->title . ' - ' . company()->name,
                'tags' => $this->page->title . ', ' . company()->name . ', Sekolah Tinggi, Pendidikan, Nias',
                'author' => company()->name,
                'type' => 'article',
                'image' => $this->page->image ?? asset('assets/images/icon/android-icon-192x192.png'),
                'url' => url()->current(),
            ]);
    }
}
