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
                                                <p>Työntekijöiden, asiakkaiden ja yhteisön hyvinvointi on meille
                                                    tärkeää.
                                                </p>
                                            </div>
                                        </article>

                                        <!-- Value Item 3 -->
                                        <article class="value-item">
                                            <div class="value-content">
                                                <h3 class="value-title">Rakkaus työhön</h3>
                                                <p>Jokainen tuote on tehty sydämellä ja ylpeydellä, jotta se välittää
                                                    aidon
                                                    maun ja tarinan.</p>
                                            </div>
                                        </article>

                                    </div>

                                    <div class="image-wrapper">
                                        <img src="images/raphael.jpg" alt="Company core values representation">
                                    </div>

                                </div>
                            </section>


                            <section class="origin-section">

                                <div class="origin-inner">

                                    <div class="origin-content">
                                        <h2 class="origin-title">Alkuperämme</h2>

                                        <p>
                                            Kaikki tuotteemme syntyvät tilaltamme, jossa puhdas luonto, pohjoisen
                                            ilmasto ja
                                            vastuullinen maatalous luovat perustan laadulle ja maulle. Meille alkuperä
                                            ei ole vain sijainti,
                                            vaan lupaus siitä, että jokainen vaihe – maaperästä valmiiseen tuotteeseen –
                                            on tehty
                                            avoimesti ja sydämellä.
                                        </p>

                                        <p>
                                            Maaperän ravinteikkuus, eläintemme hyvinvointi ja perinteiset menetelmät,
                                            joita täydentävät
                                            modernit ratkaisut, takaavat sen, että alkuperä näkyy ja maistuu jokaisessa
                                            tuotteessa.
                                        </p>

                                        <div class="origin-cards">

                                            <div class="origin-card">
                                                <h4>Puhtaat pellot</h4>
                                                <p>Viljelemme maata sen rytmissä ja kunnioitamme luonnon tasapainoa.</p>
                                            </div>

                                            <div class="origin-card">
                                                <h4>Paikallinen tuotanto</h4>
                                                <p>Kaikki syntyy omalta tilaltamme – ilman välikäsiä ja ilman
                                                    kompromisseja.</p>
                                            </div>

                                            <div class="origin-card">
                                                <h4>Aito alkuperä</h4>
                                                <p>Tuotteiden juuret ovat selkeät ja avoimesti jäljitettävissä.</p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="origin-photo"></div>

                                </div>
                            </section>

                            <section class="principles">
                                <h2>Arvomme</h2>
                                <div class="principles-grid">

                                    <div class="principle-item">
                                        <div class="icon">🌱</div>
                                        <h3>Kestävä viljely</h3>
                                        <p>Viljelemme maata luonnon rytmissä – minimoimme kuormituksen ja maksimoimme
                                            maaperän hyvinvoinnin.</p>
                                    </div>

                                    <div class="principle-item">
                                        <div class="icon">🐄</div>
                                        <h3>Eläinten hyvinvointi</h3>
                                        <p>Eläimemme elävät rauhallisessa ympäristössä, jossa niiden tarpeet ja
                                            luontainen käyttäytyminen ovat etusijalla.</p>
                                    </div>

                                    <div class="principle-item">
                                        <div class="icon">🌾</div>
                                        <h3>Puhtaat tuotantomenetelmät</h3>
                                        <p>Kaikki tuotteet syntyvät ilman turhia lisäaineita, aidosti ja luonnollisesti
                                            – kuten niiden kuuluukin.</p>
                                    </div>

                                    <div class="principle-item">
                                        <div class="icon">🤝</div>
                                        <h3>Läpinäkyvyys ja rehellisyys</h3>
                                        <p>Uskomme avoimuuteen. Kerromme ylpeydellä mistä tuotteemme tulevat ja miten ne
                                            valmistetaan.</p>
                                    </div>

                                </div>
                            </section>
                            <section class="lopetus">
                                <div class="container">
                                    <div class="text">
                                        <h2>Tervetuloa luontoon 🌿🌄</h2>
                                        <p>
                                            Pehmeät kukkulat ulottuvat horisonttiin saakka, peittyneinä tiheillä
                                            metsillä.
                                            Ilmasto on leuto, kesät pitkät ja talvet lumiset, luoden ympärilleen
                                            kauniita maisemia ympäri vuoden. ❄️
                                        </p>
                                        <p>
                                            Alue tarjoaa <span class="highlight">rauhaa ja inspiraatiota</span>
                                            kaikille, jotka haluavat paeta arjen kiireitä.
                                            Laajat metsät, kirkkaat joet ja hiljaiset niityt kutsuvat tutkimaan ja
                                            nauttimaan luonnon kauneudesta 🌺🦋.
                                        </p>
                                    </div>
                                    <div class="image-wrapper">
                                        <img src={{ asset('/images/farma2.jpg') }} alt="Luonto">


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