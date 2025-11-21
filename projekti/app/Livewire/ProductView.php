<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tuote;

class ProductView extends Component
{
    public $product;

    // Accept the product id when mounting
    public function mount($id)
    {
        $this->product = Tuote::findOrFail($id);
    }

    public function back()
    {
        $this->dispatch('backToList');
    }


    public function render()
    {
        return view('livewire.product-view');
    }
}
