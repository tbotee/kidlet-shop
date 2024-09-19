<ul class="nav">
    <li class="scroll-to-section">
        <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">
            Home
        </a>
    </li>
    @foreach($categories as $category)
        @if($category->in_menu)
            <li class="scroll-to-section">
                <a href="{{ route('category', ['categorySlug' => $category->slug]) }}"
                   class="{{ Route::is('category') && Request::segment(1) === $category->slug ? 'active' : '' }}"
                >{{ $category->name  }}</a>
            </li>
        @endif
    @endforeach
    <li class="scroll-to-section">
        <a href="{{ route('allProducts') }}" class="{{ Route::is('allProducts') ? 'active' : '' }}">
            Explore All
        </a>
    </li>
</ul>
