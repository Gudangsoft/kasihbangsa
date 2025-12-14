<?php

namespace App\Livewire\Layouts;

use App\Models\Menu;
use Livewire\Component;

class NavbarMenu extends Component
{
    public $menuItems = [];

    public function mount()
    {
        $this->menuItems = Menu::where('status', true)
        ->orderBy('number', 'asc')
        ->with(['submenus' => function ($query) {
            $query->where('status', true);
        }])
        ->get()
        ->toArray();
        // $this->menuItems = Menu::with('submenus')->where('status', true)->orderBy('number', 'asc')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.layouts.navbar-menu');
    }
}
