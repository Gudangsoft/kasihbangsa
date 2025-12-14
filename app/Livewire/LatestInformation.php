<?php

namespace App\Livewire;

use App\Models\Information;
use Livewire\Component;

class LatestInformation extends Component
{
    public $limit = 6;

    public function render()
    {
        $information = Information::with('category')
            ->where('status', true)
            ->latest()
            ->limit($this->limit)
            ->get();

        return view('livewire.latest-information', [
            'information' => $information
        ]);
    }
}
