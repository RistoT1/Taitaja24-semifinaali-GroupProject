@extends('layouts.app')

@section('title', 'Rekisteroidy')

@section('content')
    <form class="reglog_form" method="post">
        @csrf

        <label for="nimi">Nimi</label>
        <input required type="text" name="Nimi" placeholder="Nimi" value="{{ old('Nimi') }}">

        <label for="email">Email</label>
        <input required type="email" name="Sähköposti" placeholder="Email" value="{{ old('Sähköposti') }}">

        <label for="puhelin">Email</label>
        <input required type="tel" name="Puhelin" placeholder="Puhelin numero" value="{{ old('Puhelin') }}">

        <label for="password">Password</label>
        <input required type="password" name="Salasana" placeholder="Password">

        <input required type="password" name="SalasanaConfirm" placeholder="Confirm password">

        <button type="submit">Sign in</button>

        <div class="alert alert-danger">
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <h2>Do you aldready have an account?</h2>
        <a href="/kirjaudu">kirjaudu</a>
    </form>
@endsection