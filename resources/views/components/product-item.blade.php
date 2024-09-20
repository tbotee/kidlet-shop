<div class="item">
    <div class="thumb">
        <div class="hover-content">
            <ul>
                <li><a href="{{ route('product', ['categorySlug' => $product->category->slug, 'productSlug' => $product->slug]) }}"><i class="fa fa-eye"></i></a></li>
                <li><a class="add-to-cart"
                       data-id="{{ $product->id }}">
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </li>
            </ul>
        </div>
        <img src="{{ asset('assets/images/' . $product->image_path) }}" alt="">
    </div>
    <div class="down-content">
        <h4>{{ $product->name }}</h4>
        <span>${{ $product->price }}</span>
        <ul class="stars">
            <li><span>{{ $product->category->name }}</span></li>
        </ul>
    </div>
</div>
