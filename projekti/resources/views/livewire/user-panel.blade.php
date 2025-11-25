<div>
    <label for="perPage">Näytä per sivu:</label>
    <select wire:model.live="perPage">
        <option value="1">1</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>

    @if ($this -> users->count())
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 10px;">
            @foreach ($this -> users as $user)
                <div>
                    <strong>{{ $user->Nimi }}</strong><br>
                    {{ $user->Sähköposti }}<br>
                    {{ $user->Puhelin }}<br>
                    {{ $user->Rooli }}<br>
                    Luotu: {{ $user->Luotu }}
                </div>
            @endforeach
        </div>


    @else
        <p>No users found.</p>
    @endif
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif
    <form wire:submit.prevent="addUser">
        <input type="text" wire:model="Nimi">
        <input type="email" wire:model="Sähköposti">
        <input type="tel" wire:model="Puhelin">
        <input type="password" wire:model="Salasana">
        <input type="password" wire:model="SalasanaConfirm">
        <button type="submit">Lisää</button>
    </form>
</div>