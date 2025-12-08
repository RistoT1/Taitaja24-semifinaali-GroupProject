@extends('layouts.app')

@section('title', 'Profiili')

@section('content')
    <main>
        <div class="profile-wrapper">
            <div class="profile-container">
                <!-- Left Side: User Information -->
                <div class="user-info-section">
                    <div class="welcome-title">
                        <h1>Welcome, {{ $user->Nimi }}</h1>
                    </div>
                    <div class="user-info">
                        <p><strong>Email:</strong> {{ $user->Sähköposti }}</p>
                        <p><strong>Phone:</strong> {{ $user->Puhelin }}</p>
                    </div>
                    <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
                </div>

                <!-- Right Side: Change Information Form -->
                <div class="change-user-info-container">
                    <h2>Muuta tietoja</h2>
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <button>Muuta Nimi <span class="icon"><i class="fa-solid fa-sort-down"></i></span></button>
                            <input type="text" class="expanded" value="{{$user->Nimi}}">
                        </div>
                        <div class="form-group">
                            <button>Muuta sähköpostia<span class="icon"><i class="fa-solid fa-sort-up"></i></span></button>
                            <input type="email" value="{{$user->Sähköposti}}">
                        </div>
                        <div class="form-group">
                            <button>Muuta puhelin numero</button>
                            <input type="puhelin" value="{{$user->Puhelin}}">
                        </div>
                        <div class="form-group">
                            <button>Muuta salasana</button>
                        </div>
                        <button type="submit" class="save-btn">Tallenna</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection