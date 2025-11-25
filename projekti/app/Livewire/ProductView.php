<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tuote;

class ProductView extends Component
{
    public int $productId = 0;
    public string $Nimi = '';
    public string $Kategoria = '';
    public string $Kuvaus = '';
    public float $Hinta = 0;
    public string $Kuva = '';
    public bool $Tila = true;
    public bool $showForm = false;

    // Store original values
    public array $originalValues = [];

    public function mount($id)
    {
        $product = Tuote::findOrFail($id);

        $this->productId = $product->Tuote_ID ?? 0;
        $this->Nimi = $product->Nimi ?? '';
        $this->Kategoria = $product->Kategoria ?? '';
        $this->Kuvaus = $product->Kuvaus ?? '';
        $this->Hinta = $product->Hinta ?? 0;
        $this->Kuva = $product->Kuva ?? '';
        $this->Tila = $product->Tila ?? false;

        // Store original values
        $this->originalValues = [
            'Nimi' => $this->Nimi,
            'Kategoria' => $this->Kategoria,
            'Kuvaus' => $this->Kuvaus,
            'Hinta' => $this->Hinta,
            'Kuva' => $this->Kuva,
            'Tila' => $this->Tila,
        ];
    }

    public function toggleForm()
    {
        if ($this->showForm) {
            // Restore original values when canceling
            $this->Nimi = $this->originalValues['Nimi'];
            $this->Kategoria = $this->originalValues['Kategoria'];
            $this->Kuvaus = $this->originalValues['Kuvaus'];
            $this->Hinta = $this->originalValues['Hinta'];
            $this->Kuva = $this->originalValues['Kuva'];
            $this->Tila = $this->originalValues['Tila'];
        }
        $this->showForm = !$this->showForm;
    }

    public function update()
    {
        $this->validate([
            'Nimi' => 'required|string|max:255',
            'Kategoria' => 'required|string',
            'Kuvaus' => 'nullable|string',
            'Hinta' => 'required|numeric|min:0.01',
            'Kuva' => 'nullable|string',
            'Tila' => 'required|boolean',
        ]);

        if ($this->Hinta < 0.5) {
            $this->dispatch('showPriceConfirm');
            return;
        }

        $this->saveProduct();
    }

    public function saveProduct()
    {
        $product = Tuote::findOrFail($this->productId);
        $product->update([
            'Nimi' => $this->Nimi,
            'Kategoria' => $this->Kategoria,
            'Kuvaus' => $this->Kuvaus,
            'Hinta' => $this->Hinta,
            'Kuva' => $this->Kuva,
            'Tila' => $this->Tila,
        ]);

        // Update original values after saving
        $this->originalValues = [
            'Nimi' => $this->Nimi,
            'Kategoria' => $this->Kategoria,
            'Kuvaus' => $this->Kuvaus,
            'Hinta' => $this->Hinta,
            'Kuva' => $this->Kuva,
            'Tila' => $this->Tila,
        ];

        session()->flash('success', 'Product updated successfully!');
        $this->showForm = false;
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