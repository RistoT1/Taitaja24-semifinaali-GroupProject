<!DOCTYPE html>
<html>

<head>
    <title>@yield('title', 'Admin Panel')</title>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div class="admin-wrapper">

        {{-- Sidebar partial --}}
        <livewire:sidebar />

        {{-- Main content --}}
        <div class="main-container">
            @yield('content')
        </div>

    </div>

    @livewireScripts
</body>

</html>
