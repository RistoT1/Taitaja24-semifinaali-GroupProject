<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\DataContainer; 

class Sidebar extends Component
{
    public function selectPanel($panel)
    {
        // Dispatches event 'PanelSelected' directly to DataContainer component
        $this->dispatch('PanelSelected', panel: $panel)->to(DataContainer::class);
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
