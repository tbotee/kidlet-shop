@extends('layouts.products')

@section('content')

    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Our Latest Products 1</h2>
                        <span>Check out all of our products.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-lg-4">
                        <x-product-item :product="$product" />
                    </div>
                @endforeach
                <div class="col-lg-12">
                    {{ $products->onEachSide(0)->links() }}
                </div>
            </div>
        </div>
    </section>

@endsection
