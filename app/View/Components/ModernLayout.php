<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModernLayout extends Component
{
    public $title;
    public $description;
    public $tags;
    public $author;
    public $type;
    public $image;
    public $url;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $title = 'Beranda',
        $description = 'STP Dian Mandala Gunung Sitoli Nias - Sekolah Tinggi Pastoral yang berkomitmen untuk pendidikan berkualitas',
        $tags = 'STP Dian Mandala, Kampus Nias, Gunung Sitoli, Pendidikan Tinggi, Keuskupan Sibolga',
        $author = 'STP Dian Mandala',
        $type = 'website',
        $image = '',
        $url = ''
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->tags = $tags;
        $this->author = $author;
        $this->type = $type;
        $this->image = $image;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modern-layout');
    }
}
