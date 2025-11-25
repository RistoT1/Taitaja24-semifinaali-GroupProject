<div class="product-details-container">
    <div class="product-details">
        <div class="img-container">
            <img src="{{ asset('./images/' . $Kuva . '.webp') }}" alt="{{ $Nimi }}">
        </div>
        <div class="details">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(!$showForm)

                <div>
                    <h2>{{ $Nimi }}</h2>
                    <p>{{ $Kuvaus }}</p>
                </div>
                <p>Hinta: {{ $Hinta }} €</p>
                <p>Tila {{ $Tila ? 'Aktiivinen' : 'Epäaktiivinen' }}</p>
            @else
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form wire:submit.prevent="update">
                    <label for="Nimi">Name</label>
                    <input type="text" wire:model="Nimi">

                    <label for="Kategoria">Category</label>
                    <input type="text" wire:model="Kategoria">

                    <label for="Kuvaus">Description</label>
                    <textarea wire:model="Kuvaus"></textarea>

                    <label for="Hinta">Price</label>
                    <input type="number" step="0.01" wire:model="Hinta">

                    <label for="Kuva">Image filename</label>
                    <input type="text" wire:model="Kuva">

                    <label for="Tila">Status</label>
                    <select wire:model="Tila">
                        <option value="1">Aktiivinen</option>
                        <option value="0">Epäaktiivinen</option>
                    </select>

                    <button type="submit">Save</button>
                </form>
            @endif

        </div>
    </div>
    <div class="edit-product">
        <button wire:click="toggleForm">Muokkaa tuotetta</button>
    </div>
    <button wire:click="back">Takaisin listaan</button>
</div>

@script
<script>
    Livewire.on('showPriceConfirm', () => {
        if (confirm('Hinta on alle 50 senttiä. Oletko varma, että hinta on oikein?')) {
            @this.call('saveProduct');
        }
    });
</script>
@endscript