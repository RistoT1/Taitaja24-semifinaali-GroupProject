@extends('layouts.app')

@section('title', 'Kirjaudu')

@section('content')
    <div class="body_container">
        <div class="orderfresh_cont">
            <h1>Order Fresh & Delicious Food Online</h1>
            <h2>"Order Anytime, Enjoy Fresh Meals Fast"</h2>
            <div class="fresh_menu_btn">
                <a href="/products" class="register_btn index">Shop Now <i class="fa-solid fa-bag-shopping"></i></a>
                @if (auth()->user())
                    <a href="/me" class="signin_btn index">Profiili</a>
                @else
                    <a href="/kirjaudu" class="signin_btn index">Sign in</a>
                @endif
            </div>
        </div>
    </div>
    <section class="about-shop">
        <div class="container about-container">
            <div class="about-text">
                <h2>Welcome to FreshBite Online Store</h2>
                <p>
                    FreshBite is your go-to online store for fresh, high-quality products delivered straight to your door.
                    Explore our wide selection of groceries, snacks, and beverages from trusted brands.
                    We make online shopping simple, fast, and enjoyable, so you can focus on what matters most.
                </p>
                <p>
                    Enjoy daily deals, exclusive offers, and a seamless shopping experience tailored to your needs.
                    FreshBite – where quality meets convenience.
                </p>
                <div class="about-buttons">
                    <button class="btn-light" onclick="window.location.href='/products'">
                        Shop Now
                    </button>
                    <button class="btn-dark">Learn More</button>
                </div>
            </div>
            <div class="about-image">
                <img src="./images/drink.jpg" alt="Online Shopping">
            </div>
        </div>
    </section>

    <section class="mission-shop">
        <div class="container mission-container">
            <div class="mission-image">
                <img src="./images/fastdelivery.jpg" alt="Our Mission">
            </div>
            <div class="mission-text">
                <h2>Order eazy - get fast</h2>
                <p>
                    Our fast and reliable delivery brings your favorite products to your door while keeping them fresh and
                    perfectly handled. Every order is treated with care, so you always receive your groceries just the way
                    you
                    expect — fresh, safe, and right on schedule.
                </p>
                <p>
                    At FreshBite, our mission is simple: to make healthy and fresh food accessible to everyone.
                    We carefully select products to ensure quality and sustainability.
                </p>

                <div class="mission-buttons">
                    <button class="btn-light" onclick="window.location.href='/products'">Explore Products</button>
                    <button class="btn-dark" onclick="window.location.href='/about'">Read More</button>
                </div>
            </div>
        </div>
    </section>



    <section class="categories-section">
        <div class="container">
            <h2 class="section-title">Shop by Categories</h2>
            <p class="section-subtitle">Find everything you need — fresh, fast and delivered to your door.</p>

            <div class="categories-grid">

                <a href="#" class="category-card">
                    <img src="./images/vegetables.jpg" alt="Fresh Vegetables">
                    <div class="category-info">
                        <h3>Fresh Vegetables</h3>
                        <p>Organic & local greens</p>
                    </div>
                </a>

                <a href="#" class="category-card">
                    <img src="./images/meat.jpg" alt="Meat & Poultry">
                    <div class="category-info">
                        <h3>Meat & Poultry</h3>
                        <p>Quality cuts delivered fast</p>
                    </div>
                </a>

                <a href="#" class="category-card">
                    <img src="./images/soda.jpg" alt="Beverages">
                    <div class="category-info">
                        <h3>Beverages</h3>
                        <p>Sodas, juices & more</p>
                    </div>
                </a>

                <a href="#" class="category-card">
                    <img src="./images/Karkit-scaled.jpg" alt="Snacks & Sweets">
                    <div class="category-info">
                        <h3>Snacks & Sweets</h3>
                        <p>Treat yourself anytime</p>

                    </div>
                </a>

            </div>
        </div>
    </section>


    </div>
    <section class="reviews-section">
        <div class="container">

            <h2 class="reviews-title">What Our Customers Say</h2>
            <p class="reviews-subtitle">Real feedback from people who enjoy shopping with FreshBite.</p>

            <div class="reviews-grid">

                <div class="review-card">
                    <div class="review-header">
                        <img src="./images/ginger.jpg" alt="User 1" class="review-avatar">
                        <div>
                            <h3>Emily Johnson</h3>
                            <div class="stars">★★★★★</div>
                        </div>
                    </div>
                    <p class="review-text">
                        “FreshBite always delivers fresh products quickly. I love the fast service and great quality!”
                    </p>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <img src="./images/johnpork.jpg" alt="User 2" class="review-avatar">
                        <div>
                            <h3>John Pork</h3>
                            <div class="stars">★★★★★</div>
                        </div>
                    </div>
                    <p class="review-text">
                        “Amazing service! Prices are good and the delivery is always on time. Highly recommended.”
                    </p>
                </div>

                <div class="review-card">
                    <div class="review-header">
                        <img src="./images/sofie.jpg" alt="User 3" class="review-avatar">
                        <div>
                            <h3>Sophia Miller</h3>
                            <div class="stars">★★★★☆</div>
                        </div>
                    </div>
                    <p class="review-text">
                        “Great selection of products. I especially love the fresh vegetables — always super fresh!”
                    </p>
                </div>

            </div>
        </div>
    </section>
@endsection