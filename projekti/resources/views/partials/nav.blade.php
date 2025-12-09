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
                        <li><a href="/contacts">Contacts</a></li>
                    </ul>

                    <div class="header_menu_btn">

                        <div class="cart_nav">
                            <a href="/cart" class="cart_btn"><img src="{{ asset('./images/cart.png') }}" alt="Cart"></a>
                            @if (session()->has('cart') && count(session('cart')) > 0)
                                <div id="cartCount" class="cart_count">{{ count(session('cart')) }}</div>
                            @else
                                <div id="cartCount" class="cart_count" style="display: none;">0</div>
                            @endif
                        </div>
                        
                        @auth
                            <span style="text-align: center; display: flex; align-items: center;">Welcome,
                                {{ auth()->user()->Sähköposti }}</span>
                            <button class="signin_btn"><a href="/me">Profiili</a></button>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="register_btn">Logout</button>
                            </form>
                        @else
                            <button class="signin_btn"><a href="/kirjaudu">Sign in</a></button>
                            <button class="register_btn"><a href="/rekisteroidy">Register</a></button>
                        @endauth
                    </div>
                </div>

                <button class="burger_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="burger_menu_bg">
                    <ul class="burger_menu_list">
                        <div class="cart_nav">
                            <a href="/cart" class="cart_btn"><img src="{{ asset('./images/cart.png') }}" alt="Cart"></a>
                            @if (session()->has('cart') && count(session('cart')) > 0)
                                <div class="cart_count">{{ count(session('cart')) }}</div>
                            @endif
                        </div>
                        <li><a href="/">Home</a></li>
                        <li><a href="/products">Products</a></li>
                        <li><a href="/about">About</a></li>
                        <li><a href="/contacts">Contacts</a></li>
                        @auth
                            <li><span style="text-align: center; display: flex; align-items: center;">Welcome,
                                    {{ auth()->user()->Sähköposti }}</span></li>
                            <li><a href="/me">Profiili</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a href="/kirjaudu">Sign in</a></li>
                            <li><a href="/rekisteroidy">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="line"></div>
</header>
<script>
    const burgerBtn = document.querySelector(".burger_menu");
    const burgerMenu = document.querySelector(".burger_menu_bg");

    // Function to toggle burger menu state
    const toggleBurgerMenu = (e) => {
        if (e) e.stopPropagation(); // Stop event bubbling for the click on the button
        burgerMenu.classList.toggle("active_burger");
        burgerBtn.classList.toggle("active");
    };

    // Toggle burger menu on button click
    burgerBtn.addEventListener("click", toggleBurgerMenu);

    // Close menu if clicking outside (on the body, not the button or the menu itself)
    document.body.addEventListener("click", (e) => {
        if (burgerMenu.classList.contains("active_burger")) {
            // Check if the click is outside the burger button and outside the burger menu
            if (!e.target.closest(".burger_menu") && !e.target.closest(".burger_menu_bg")) {
                burgerMenu.classList.remove("active_burger");
                burgerBtn.classList.remove("active");
            }
        }
    });
</script>