<header>
    <div class="header_menu">
        <div class="container">
            <nav class="header_menu_wrapper">
                <button class="header_menu_logo">
                    <img src="{{ asset('./images/—Pngtree—store shop front in black_15793351 4.png') }}" alt="logo">
                </button>
                <div class="header_menu_right">
                    <ul class="header_menu_list">
                        <li><a href="/">Home</a></li>
                        <li><a href="/products">Products</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="">Contacts</a></li>
                    </ul>
                    <div class="header_menu_btn">
                        @auth
                            {{-- User is logged in --}}
                            <span>Welcome, {{ auth()->user()->Sähköposti }}</span>
                            <a href="/me">profiili</a>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="register_btn">Logout</button>
                            </form>
                        @else
                            {{-- User is not logged in --}}
                            <button class="signin_btn"><a href="/kirjaudu">Sign in</a></button>
                            <button class="register_btn"><a href="/rekisteroidy">Register</a></button>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="line"></div>
</header>
