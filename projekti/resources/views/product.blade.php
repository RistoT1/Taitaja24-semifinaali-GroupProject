@extends('layouts.app')

@section('title', 'Tuotteet')

@section('content')
    <main>
        <section class="products_details">
            <div class="container">
                <div class="products_details_wrapper">
                    @foreach($tuotteet as $tuote)
                        <div class="products_details_left">
                            <div class="product-details-img">
                                <img src="{{ asset('images/' . $tuote->Kuva) }}.jpg" alt="photo"
                                    onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}';"
                                    loading="lazy">
                            </div>
                            <button class="favorites_btn">
                                <span class="heart">❤</span>
                            </button>
                        </div>
                        <div class="products_details_right">

                            <h2 class="products_details_name"> {{ $tuote->Nimi }}</h2>

                            <h3 class="products_details_price">{{ $tuote->Hinta  }}€</h3>
                            <div class="products_details_desc" id="text">
                                {{$tuote->Kuvaus}}
                                <div class="kategoria" id="kategory" data-product-kategoria="{{ $tuote->Kategoria }}">
                                    {{ $tuote->Kategoria }}</div>
                            </div>
                            <button class="toggle_btn">Show more</button>
                            <div class="products_details_quantity">
                                <button class="qty-btn" id="decrease">-</button>
                                <span class="qty-value" id="qty">1</span>
                                <button class="qty-btn" id="increase">+</button>
                            </div>
                            <div class="notification" id="notification">

                            </div>
                            <button class="products_details_buybtn" id="addtocart"
                                data-product-id="{{ $tuote->Tuote_ID }}">Lisää koriin</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="reviews">
            <div class="container">
                <h2 class="reviews_title">Latest reviews</h2>
                <div class="carousel-container">
                    <button class="carousel_btn prev">&#10094;</button>
                    <div class="reviews_wrapper">
                        <div class="reviews_carousel" id="reviewCarousel">

                            <div class="review_card">
                                <div class="stars">★★★★★</div>
                                <h3>Loistava tuote!</h3>
                                <p>Ostin tämän viime viikolla, ja se ylitti odotukseni täysin. Laatu on erinomainen.</p>
                                <div class="reviewer">
                                    <img src="images/Avatar.png" alt="avatar">
                                    <div>
                                        <strong>Maria K.</strong>
                                        <div class="date">20.11.2025</div>
                                    </div>
                                </div>
                            </div>

                            <div class="review_card">
                                <div class="stars">★★★★☆</div>
                                <h3>Hyvä hinta-laatusuhde</h3>
                                <p>Tuote toimii hyvin, mutta toimitus kesti hieman kauemmin kuin odotin.</p>
                                <div class="reviewer">
                                    <img src="images/Avatar.png" alt="avatar">
                                    <div>
                                        <strong>Jussi L.</strong>
                                        <div class="date">18.11.2025</div>
                                    </div>
                                </div>
                            </div>

                            <div class="review_card">
                                <div class="stars">★★★☆☆</div>
                                <h3>Toimii, mutta parannettavaa</h3>
                                <p>Tuote on ihan ok, mutta ohjeistus voisi olla selkeämpi.</p>
                                <div class="reviewer">
                                    <img src="images/Avatar.png" alt="avatar">
                                    <div>
                                        <strong>Tiina M.</strong>
                                        <div class="date">15.11.2025</div>
                                    </div>
                                </div>
                            </div>

                            <div class="review_card">
                                <div class="stars">★★★★★</div>
                                <h3>Erinomainen asiakaspalvelu</h3>
                                <p>Tilauksen tekeminen oli helppoa ja asiakaspalvelu auttoi nopeasti kysymyksiin.</p>
                                <div class="reviewer">
                                    <img src="images/Avatar.png" alt="avatar">
                                    <div>
                                        <strong>Antti P.</strong>
                                        <div class="date">12.11.2025</div>
                                    </div>
                                </div>
                            </div>

                            <div class="review_card">
                                <div class="stars">★★★★☆</div>
                                <h3>Suosittelen ystäville</h3>
                                <p>Tuote vastasi odotuksia ja pakkaus oli siisti. Pieni parannus toimitukseen olisi hyvä.
                                </p>
                                <div class="reviewer">
                                    <img src="images/Avatar.png" alt="avatar">
                                    <div>
                                        <strong>Liisa H.</strong>
                                        <div class="date">10.11.2025</div>
                                    </div>
                                </div>
                            </div>

                            <div class="review_card">
                                <div class="stars">★★★☆☆</div>
                                <h3>OK, mutta ei erinomainen</h3>
                                <p>Toimii, mutta ei ole aivan hintansa arvoinen. Käyttökokemus on keskinkertainen.</p>
                                <div class="reviewer">
                                    <img src="images/Avatar.png" alt="avatar">
                                    <div>
                                        <strong>Markku S.</strong>
                                        <div class="date">08.11.2025</div>
                                    </div>
                                </div>
                            </div>

                            <div class="review_card">
                                <div class="stars">★★★★★</div>
                                <h3>Pidin todella paljon!</h3>
                                <p>Laatu ja ulkonäkö ovat juuri sitä mitä odotin. Tilaan varmasti uudestaan.</p>
                                <div class="reviewer">
                                    <img src="images/Avatar.png" alt="avatar">
                                    <div>
                                        <strong>Sanna V.</strong>
                                        <div class="date">05.11.2025</div>
                                    </div>
                                </div>
                            </div>

                            <div class="review_card">
                                <div class="stars">★★★★☆</div>
                                <h3>Hyvä perustuote</h3>
                                <p>Ei yllä aivan premium-tasoon, mutta hintaan nähden todella hyvä ostos.</p>
                                <div class="reviewer">
                                    <img src="images/Avatar.png" alt="avatar">
                                    <div>
                                        <strong>Kari N.</strong>
                                        <div class="date">02.11.2025</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel_btn next">&#10095;</button>
                </div>
            </div>
        </section>
        <section class="recipe-section">
            <div class="recipe-container">
                <div class="img-background">
                    <div class="recipe-content-wrapper">
                        <!-- Left side: Text (50%) -->
                        <div class="recipe-title-container" id="recipeTitle">
                            <h1>Makua pöytään</h1>
                            <h2>resepti-ideoilla!</h2>
                            <div class="recipe-title-desc">
                                <p>Tutustu kaupamme maistuviin resepteihin tästä ja löydä uusia ideoita arkeen sekä juhlaan.
                                    Inspiroidu herkullisista makuyhdistelmistä ja kokeile reseptejä, jotka tuovat iloa
                                    keittiöösi.</p>
                            </div>
                        </div>

                        <!-- Right side: Carousel (50%) -->
                        <div class="recipe-carousel" id="recipeCarousel">
                            <div class="recipe-item-container">
                                <button class="recipe-arrow left-arrow" id="recipePrev">&#10094;</button>

                                <div class="recipe-card" id="recipeCard">
                                    <div class="recipe-img-container">
                                        <div id="recipeImg" class="recipe-img"></div>
                                    </div>
                                </div>

                                <button class="recipe-arrow right-arrow" id="recipeNext">&#10095;</button>

                                <div class="recipe">
                                    <h2>Porkkana keitto</h2>
                                    <div class="recipe-tutorial-toggle-container">
                                        <div class="toggle-group">
                                            <button class="recipe-tutorial-toggle-btn toggled"
                                                data-target="Ainesosat">Ainesosat</button>
                                            <button class="recipe-tutorial-toggle-btn"
                                                data-target="Valmistus">Valmistus</button>
                                        </div>
                                    </div>
                                    <div class="recipe-tutorial">
                                        <div class="tutorial-section selected" id="Ainesosat">
                                            <h3>Ainesosat</h3>
                                            <ul>

                                            </ul>
                                        </div>
                                        <div class="tutorial-section" id="Valmistus">
                                            <h3>Valmistusohjeet</h3>
                                            <ol>

                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-section">
            <div class="section-wrap">
                <div class="about-container">
                    <div class="about-content">
                        <div class="row">
                            <div class="about-subtitle">
                                <h3 class="about_title">Rakkaudella tuotettu</h3>
                            </div>
                            <section class="core-values-section">
                                <div class="value-text-container">
                                    <p>Meidän tilalla jokainen päivä alkaa luonnon kunnioittamisesta ja vastuullisesta
                                        työstä. Emme näe maataloutta vain tuotantona, vaan kokonaisuutena, jossa maa,
                                        eläimet ja ihmiset elävät rinnakkain ja tukevat toisiaan. Jokainen pellon korsi,
                                        jokainen kasvi ja jokainen eläin kertoo tarinaa siitä, että hyvinvointi ja
                                        kestävyys kulkevat käsi kädessä.
                                    </p>
                                    <p> Tuotteemme syntyvät rakkaudella ja huolella – puhtaina, laadukkaina ja
                                        luotettavina. Kun ne päätyvät pöydällesi, voit olla varma, että niiden taustalla
                                        on paitsi ammattitaito myös sydämellinen sitoutuminen. Meille on tärkeää, että
                                        jokainen asiakas saa enemmän kuin pelkän tuotteen: hän saa palan tilamme tarinaa
                                        ja kestävää tulevaisuutta.
                                    </p>
                                </div>
                                <div class="value-container">
                                    <div class="values-list">
                                        <article class="value-item">
                                            <div class="value-content">
                                                <h3 class="value-title">Vastuullisuus</h3>
                                                <p> Huolehdimme luonnosta, eläimistä ja ihmisistä, jotta jokainen tuote
                                                    syntyy kestävällä tavalla</p>
                                            </div>
                                        </article>

                                        <!-- Value Item 2 -->
                                        <article class="value-item item-right">
                                            <div class="value-content">
                                                <h3 class="value-title"> Hyvinvointi</h3>
                                                <p>Työntekijöiden, asiakkaiden ja yhteisön hyvinvointi on meille tärkeää.
                                                </p>
                                            </div>
                                        </article>

                                        <!-- Value Item 3 -->
                                        <article class="value-item">
                                            <div class="value-content">
                                                <h3 class="value-title">Rakkaus työhön</h3>
                                                <p>Jokainen tuote on tehty sydämellä ja ylpeydellä, jotta se välittää aidon
                                                    maun ja tarinan.</p>
                                            </div>
                                        </article>

                                    </div>

                                    <div class="image-wrapper">
                                        <img src="{{ asset('images/raphael.jpg') }}"
                                            alt="Company core values representation">
                                    </div>

                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset('js/product.js') }}" defer></script>
@endsection