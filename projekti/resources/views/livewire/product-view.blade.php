<div class="product-details">
    <h2>{{ $product->Nimi }}</h2>
    <p>{{ $product->Kuvaus }}</p>
    <p>Hinta: {{ $product->Hinta }} €</p>

    <button wire:click="back">Takaisin listaan</button>
</div>