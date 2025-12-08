@extends('layouts.app')

@section('title', 'Kirjaudu')

@section('content')
    <section class="reglog">
        <div class="container">
            <h2 class="reglog_title">Sign in</h2>

            <form class="reglog_form" method="post">
                @csrf
                <label for="email">Email</label>
                <input required type="email" name="sähköposti" placeholder="Email">
                <label for="password">Password</label>
                <input required type="password" name="SalasanaHash" placeholder="Password">
                <button type="submit">Sign in</button>
                <div id="loadingMessage" class="alert alert-info" style="display:none; width:100%;">
                    <p>This might take a while, please wait...</p>
                </div>

                <div class="alert alert-danger">
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <h2>New one?</h2>
                <a href="rekisteroidy">Rekisteröidy</a>
            </form>
        </div>

        <script>
            const button = document.querySelector('button[type="submit"]');

            button.addEventListener("click", function () {
                document.getElementById("loadingMessage").style.display = 'block';
            });
        </script>
    </section>
@endsection