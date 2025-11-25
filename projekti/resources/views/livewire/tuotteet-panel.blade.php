<div class="tuotteet-panel">
    <div class="tittle-container">
        <h4 class="panel-title panel-title-1">Panel 1 (Tuotteet)</h4>
    </div>
    <div class="data-container">
        @if($this->panelData['TotalCount'] === 0)
            <p>No tuotteet found.</p>
        @endif

        <div class="row">
            <div class="tuote-count">
                <h2>Myymälässä</h2>
                <h3>{{ $this->panelData['ActiveCount'] }}</h3>
            </div>
            <div class="tuote-count">
                <h2>Kaikki tuotteet</h2>
                <h3>{{ $this->panelData['TotalCount'] }}</h3>
            </div>
        </div>

        <div class="row">
            <div class="search-bar">
                <input type="text" wire:model.live.debounce.200ms="searchTerm" placeholder="Hae tuotteita...">

                <select wire:model.live="searchCategory">
                    <option value="">-- Valitse kategoria --</option>
                    @foreach($this->categories as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>

                <select wire:model.live="searchOrder">
                    <option value="">-- Valitse järjestys --</option>
                    <option value="created_at_asc">Newest first</option>
                    <option value="created_at_desc">Oldest first</option>
                    <option value="price_asc">Cheapest first</option>
                    <option value="price_desc">Most expensive first</option>
                </select>
            </div>
        </div>


        <ul>
            @forelse($this->tuotteet as $item)
                <li wire:key="tuote-{{ $item->Tuote_ID }}" wire:click="productView({{ $item->Tuote_ID }})"
                    style="cursor: pointer;">
                    <strong>{{ $item->Nimi }}</strong> – {{ $item->Hinta }} €
                    <small>{{ $item->Kuvaus }}</small>
                </li>
            @empty
                <li>No products found</li>
            @endforelse
        </ul>

        <div class="pagination-wrapper">
            {{ $this->tuotteet->links('vendor.livewire.custom-pagination') }}

        </div>
    </div>
</div>