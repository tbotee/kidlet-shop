@extends('layouts.app')

@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <div class="thumb">
                            <div class="inner-content">
                                <h4>We Are Kidlet</h4>
                                <span>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</span>
                                <div class="main-border-button">
                                    <a href="{{ route('allProducts') }}">Explore Products</a>
                                </div>
                            </div>
                            <img src="{{ asset('assets/images/left-banner-image.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            @foreach($categories as $category)
                                <x-banner-category :category="$category" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <x-latest-product-list title="Women's Latest" :slug="config('constants.category_slug.womens')" />

    <x-latest-product-list title="Men's Latest" :slug="config('constants.category_slug.mens')" />

    <x-latest-product-list title="Kid's Latest" :slug="config('constants.category_slug.kids')" />

    <section class="section" id="explore">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content">
                        <h2>Explore Our Products</h2>
                        <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                        <div class="quote">
                            <i class="fa fa-quote-left"></i><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        </div>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <div class="main-border-button">
                            <a href="{{ route('allProducts') }}">Discover More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="leather">
                                    <h4>Leather Bags</h4>
                                    <span>Latest Collection</span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="first-image">
                                    <img src="{{ asset('assets/images/explore-image-01.jpg')  }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="second-image">
                                    <img src="{{ asset('assets/images/explore-image-02.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="types">
                                    <h4>Different Types</h4>
                                    <span>Over 304 Products</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
