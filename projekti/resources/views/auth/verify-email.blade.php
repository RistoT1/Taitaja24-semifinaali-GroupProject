@extends('layouts.app')

@section('title', 'Vahvista sähköposti')

@section('content')
    <section class="reglog">
        <div class="container">
            <h1>Vahvista sähköposti</h1>

            <p>
                Kiitos rekisteröitymisestä!  
                Ennen kuin jatkat, vahvista sähköpostiosoitteesi klikkaamalla
                linkkiä, joka lähetettiin sinulle sähköpostiin.
            </p>

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session('verified'))
                <div class="alert alert-success">
                    Sähköpostisi on vahvistettu!
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit">Lähetä vahvistuslinkki uudelleen</button>
            </form>

            <p style="margin-top: 20px;">
                <a href="{{ route('logout') }}">Kirjaudu ulos</a>
            </p>
        </div>
    </section>
@endsection