<!DOCTYPE html>
<html>

<head>
    <title>Tuotteet</title>
</head>

<body>
    <h1>Tuotteet</h1>

    @if (!empty($error))
        <div style="color:red;font-weight:bold;">{{ $error }}</div>
    @endif

    @if ($tuotteet->isEmpty())
        <p>Ei tuotteita näytettäväksi.</p>
    @else
        <ul>
            @foreach ($tuotteet as $tuote)
                <li>{{ $tuote->Nimi }} – €{{ $tuote->Hinta }}</li>
            @endforeach
        </ul>
    @endif

</body>

</html>