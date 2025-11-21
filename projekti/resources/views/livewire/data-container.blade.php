<div class="data-container-wrapper">
    <div wire:loading class="overlay"><span class="spinner"></span></div>

    @if($activePanel === 'tuotteet')
        @if($selectedProductId)
            <livewire:product-view :id="$selectedProductId" />
        @else
            <livewire:tuotteet-panel />
        @endif
    @elseif($activePanel === 'panel2')
        <livewire:user-settings-panel wire:key="settings-panel" />
    @elseif($activePanel === 'panel3')
        <livewire:system-logs-panel wire:key="logs-panel" />
    @endif
</div>