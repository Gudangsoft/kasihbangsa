<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Information;

class LatestNewsInformation extends Component
{
    public function render()
    {
        $latestPosts = Post::where('status', true)
            ->with('category')
            ->latest()
            ->limit(4)
            ->get();

        $latestInformations = Information::where('status', true)
            ->with('category')
            ->latest()
            ->limit(4)
            ->get();

        return view('livewire.latest-news-information', [
            'latestPosts' => $latestPosts,
            'latestInformations' => $latestInformations,
        ]);
    }
}
