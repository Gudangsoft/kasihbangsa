<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderPage extends Component
{
    public $title;
    public $subtitle;
    public bool $maintitle;

    public function __construct($title, $subtitle = null, $maintitle = false)
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->maintitle = $maintitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header-page');
    }
}
