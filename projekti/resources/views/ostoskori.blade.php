@extends('layouts.app')

@section('title', 'Tuotteet')

@section('content')

    <main>
        <section class="Ostoskori">
            <h2 class="osto-title">Ostoskori</h2>
            <div class="osto-container">
                @if (empty($Tuotteet))
                    <p>Ostoskori on tyhjä.</p>
                @else
                    <div class="prod-table">

                        @foreach ($Tuotteet as $Tuote)
                            <div class="one-row" data-item="{{ $Tuote['tuote']->Tuote_ID }}">
                                <img src="{{ asset('images/' . (!empty($Tuote['tuote']->Kuva) ? $Tuote['tuote']->Kuva : 'placeholder') . '.jpg') }}"
                                    alt="{{ $Tuote['tuote']->Nimi }}" class="item-img">
                                <div class="item-info">
                                    <div class="item-title">{{ $Tuote['tuote']->Nimi }}</div>
                                    <div class="item-desc">{{ $Tuote['tuote']->Kuvaus }}</div>
                                </div>
                                <div class="item-qty">Määrä {{$Tuote['quantity']}}</div>
                                <div class="item-controls">
                                    <button id="decrease-{{ $Tuote['tuote']->Tuote_ID }}">−</button>
                                    <span class="counter" id="counter-{{ $Tuote['tuote']->Tuote_ID }}">{{$Tuote['quantity']}}</span>
                                    <button id="increase-{{ $Tuote['tuote']->Tuote_ID }}">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="order-table">
                        <div class="order-form-container">
                            @if (auth()->user())
                                <form class="form-container" id="orderForm" method="post" action="/cart/checkout">
                                    @csrf
                                    <button type="submit">Lisää tilaus</button>
                                </form>
                            @else
                                <div class="signin-prompt">
                                    <p>Kirjaudu sisään tehdäksesi tilauksen.</p>
                                    <button class="signin_btn"><a href="/kirjaudu">Sign in</a></button>
                                </div>
                            @endif

                        </div>
                    </div>
                @endif
            </div>
        </section>
        <script>

            const prodTable = document.querySelector('.prod-table');
            const ostoContainer = document.querySelector('.osto-container');
            const orderForm = document.getElementById('orderForm');
            let debounceTimers = {};

            function debounceUpdate(itemId, quantity) {
                // cancel previous timer for this item
                clearTimeout(debounceTimers[itemId]);

                // create a new one
                debounceTimers[itemId] = setTimeout(() => {
                    updateServer(itemId, quantity);
                }, 300); // wait 300ms after last click
            }

            async function updateServer(itemId, quantity) {
                try {
                    const response = await fetch(`/cart/update-item`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ TuoteID: itemId, quantity: quantity })
                    });

                    if (!response.ok) {
                        throw new Error(`Server responded with ${response.status}`);
                    }

                    const data = await response.json();
                    console.log("Server success:", data);
                }
                catch (error) {
                    console.error("Request failed:", error);
                }
            }

            document.querySelectorAll('.one-row').forEach(container => {

                const itemId = container.dataset.item;
                const counter = container.querySelector(`#counter-${itemId}`);
                const inc = container.querySelector(`#increase-${itemId}`);
                const dec = container.querySelector(`#decrease-${itemId}`);

                let count = parseInt(counter.textContent);

                inc.addEventListener("click", () => {
                    if (count >= 99) return;
                    count++;
                    counter.textContent = count;
                    const itemQtyText = container.querySelector(".item-qty");
                    itemQtyText.textContent = `Määrä ${count}`;
                    debounceUpdate(itemId, count);
                });

                dec.addEventListener("click", async () => {
                    count--;
                    counter.textContent = count;

                    if (count === 0) {
                        container.style.display = 'none';
                        console.log('Removing item', itemId);
                        try {
                            const response = await fetch(`/cart/remove-item`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({ TuoteID: itemId })
                            });

                            if (!response.ok) {
                                throw new Error(`Server responded with ${response.status}`);
                            }

                            const data = await response.json();
                            console.log("Server success:", data);
                            clearTimeout(debounceTimers[itemId]);
                            delete debounceTimers[itemId];
                            container.remove();
                        }
                        catch (error) {
                            container.style.display = 'flex';
                            count++;
                            counter.textContent = count;
                            alert("Tuotteen poistaminen ostoskorista epäonnistui. Yritä uudelleen.");
                            console.error("Request failed:", error);
                        }
                    }

                    if (count > 0) {
                        debounceUpdate(itemId, count);
                    }
                    const itemQtyText = container.querySelector(".item-qty");
                    itemQtyText.textContent = `Määrä ${count}`;

                    if (prodTable.children.length === 0) {
                        ostoContainer.innerHTML = '<p>Ostoskori on tyhjä.</p>';
                    }

                });

            });
        </script>
    </main>
@endsection