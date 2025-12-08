@extends('layouts.app')

@section('title', 'Tuotteet')

@section('content')
    <main>
        <section class="products">
            <div class="container">
                <div class="products_wrapper">
                    <button class="filters_toggle">Filters &#9776;</button>
                    <div class="products_left">
                        <h3>Price</h3>
                        <div class="price_inputs">
                            <div class="price_input_box">
                                <label for="minPrice">Min (€)</label>
                                <input type="number" id="minPrice" placeholder="0">
                            </div>
                            <div class="price_input_box">
                                <label for="maxPrice">Max (€)</label>
                                <input type="number" id="maxPrice" placeholder="500">
                            </div>
                        </div>
                        <h3 id="manufacturer_title" class="toggle_title">Manufacturer</h3>
                        <ul class="manufacturer_list" id="manufacturer_list"></ul>
                        <div class="categories_block">
                            <h3 class="categories_title">Categories</h3>
                            <ul class="products_left_categories">
                                <li class="categories_item">
                                    <a href="#">Promotions and discount products</a>
                                </li>
                                <li class="categories_item">
                                    <a href="#">New products</a>
                                </li>
                            </ul>
                        </div>


                    </div>
                    <div class="products_right">
                        <div class="products_right_nav">
                            <input type="text" name="search_input" class="search_input" placeholder="Search products">
                            <div class="filter-buttons">
                                <button>New</button>
                                <button>Price ascending</button>
                                <button>Price descending</button>
                                <button>Rating</button>
                            </div>
                        </div>
                        <div class="product-grid" id="productGrid"> </div>
                        <div  class="loadmore-button-container">
                            <button class="loadmore-button" id="loadmoreBtn">load more</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="{{ asset("js/products.js") }}"></script>
@endsection