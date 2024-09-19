@if($category->in_home_banner)
    <div class="col-lg-6">
        <div class="right-first-image">
            <div class="thumb">
                <div class="inner-content">
                    <h4>{{ $category->name }}</h4>
                    <span>Best Quality</span>
                </div>
                <div class="hover-content">
                    <div class="inner">
                        <h4>{{ $category->name }}</h4>
                        <p>Lorem ipsum dolor sit amet, conservisii ctetur adipiscing elit incid.</p>
                        <div class="main-border-button">
                            <a href="{{ route('category', ['categoryId' => $category->slug]) }}">Discover More</a>
                        </div>
                    </div>
                </div>
                <img src="{{ asset($category->image_path) }}">
            </div>
        </div>
    </div>
@endif
