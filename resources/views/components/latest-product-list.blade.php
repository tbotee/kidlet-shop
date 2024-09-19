<section class="section" id="men">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>{{ $title }}</h2>
                    <span>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">
                        @foreach($products as $product)
                            <x-product-item :product="$product" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
