@extends('layouts.app')

@section('title', 'Rekisteroidy')

@section('content')
    <section>
        <div class="kiitos-tilaus">
            <h1>Kiitos Paljon Tilauksesta!</h1>
            <p class="toimitamme">Toimitamme tuotteenne mahdollisimman pian!</p>
            <p class="kysy">Kysyttävää?</p>
            <p>Sivu uudelleen ohjautuu päivittäessä</p>
            <button class="copy">Randomassemail@gmail.com</button>
            @if(session()->has('order_data'))
                <div class="alert alert-success">
                    <p>Tilaus Numero: {{ session('order_data.order_id') }}</p>
                </div>
            @endif
        </div>
    </section>
    <script>
        const copyButton = document.querySelector(".copy");


        const tooltip = document.createElement("span");
        tooltip.className = "tooltip";
        tooltip.textContent = "Copied!";
        document.body.appendChild(tooltip);

        copyButton.addEventListener("click", () => {
            const textToCopy = copyButton.textContent;

            navigator.clipboard.writeText(textToCopy)
                .then(() => {

                    const rect = copyButton.getBoundingClientRect();
                    tooltip.style.left = rect.left + window.scrollX + rect.width / 2 - tooltip.offsetWidth / 2 + "px";
                    tooltip.style.top = rect.top + window.scrollY - 30 + "px";
                    tooltip.style.opacity = 1;


                    setTimeout(() => {
                        tooltip.style.opacity = 0;
                    }, 1500);
                })
                .catch(err => {
                    console.error("Failed to copy text: ", err);
                });
        });
    </script>
@endsection