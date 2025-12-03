@extends('layouts.app')

@section('title', 'Tuotteet')

@section('content')
    <main>
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
@endsection