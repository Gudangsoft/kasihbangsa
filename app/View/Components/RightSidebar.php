<?php

namespace App\View\Components;

use App\Models\Gallery;
use App\Models\Post;
use App\Models\PostCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RightSidebar extends Component
{
    public $latest_posts;

    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->latest_posts = Post::where('status', true)->limit(5)->get();

        return view('components.right-sidebar', [
            'latest_posts' => $this->latest_posts,
            'categories' => PostCategory::limit(10)->get(),
            'galleries' => Gallery::limit(10)->get(),
        ]);
    }
}
