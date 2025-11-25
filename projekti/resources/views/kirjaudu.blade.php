<!DOCTYPE html>
<html lang="fi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="{{ asset('css/loginPage.css') }}">
</head>

<body>
    <header>
        <div class="header_menu">
            <div class="container">
                <nav class="header_menu_wrapper">
                    <button class="header_menu_logo"><img
                            src="./images/—Pngtree—store shop front in black_15793351 4.png" alt="logo"></button>
                    <div class="header_menu_right">
                        <ul class="header_menu_list">
                            <li><a href="#">Products</a></li>
                            <li><a href="#">Solutions</a></li>
                            <li><a href="#">Community</a></li>
                            <li><a href="#">Resources</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Contacts</a></li>
                            <li><a href="#">Link</a></li>
                        </ul>
                        <div class="header_menu_btn">
                            <button class="signin_btn"><a href="login.html">Sign in</a></button>
                            <button class="register_btn"><a href="register.html">Register</a></button>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="line"></div>
    </header>
    <main>
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
                </form>
            </div>
        </section>
    </main>
    <footer>
        <div class="line"></div>
        <div class="container">
            <div class="footer_wrapper">
                <div class="footer_list">
                    <h3>Tekijät</h3>
                    <div class="footer_list_items">
                        <a href="#">Risto <img src="./images/Github.png" alt="logo"></a>
                        <a href="#">Danyil<img src="./images/Github.png" alt="logo"></a>
                        <a href="#">Daria <img src="./images/Github.png" alt="logo"></a>
                    </div>
                </div>
                <div class="footer_list">
                    <h3>Linkit</h3>
                    <div class="footer_list_items">
                        <a href="#">Tuotteet</a>
                        <a href="#">Ostoskori</a>
                        <a href="#">Meistä</a>
                    </div>
                </div>
                <div class="footer_info">
                    <h3>Tietoa</h3>
                    <p>Kouluprojekti joka on tehty redbullilla ja päiväunilla ja rukoillen, että deadlinet eivät
                        paukkuisi. Hajottaa mut kyllä tästä selvittiin.</p>
                </div>
                <img class="school_logo" src="./images/Savon_koulutuskuntayhtyma_logo 1.png" alt="school_logo">
            </div>
        </div>
    </footer>
</body>

</html>