<?php

namespace App\Livewire;

use Livewire\Component;

class DataContainer extends Component
{
    public $activePanel = 'tuotteet';
    public $selectedProductId = null;

    
    protected $listeners = [
        'PanelSelected' => 'setActivePanel',
        'backToList'    => 'resetProduct',   
        'productView'   => 'productView',
    ];

    public function setActivePanel($panel)
    {
        $this->activePanel = $panel;
    }

    public function productView($id)
    {
        $this->selectedProductId = $id;
    }

    public function resetProduct()
    {
        $this->selectedProductId = null;
    }


    public function render()
    {
        return view('livewire.data-container');
    }
}