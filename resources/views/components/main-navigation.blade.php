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
            Explore
        </a>
    </li>
    @if(auth()->check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li class="scroll-to-section">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                   data-toggle="tooltip" data-placement="top" title="Logout">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                </a>
            </li>
        </form>
    @else
        <li class="scroll-to-section">
            <a href="{{ route('login') }}"
               data-toggle="tooltip" data-placement="top" title="Login">
                <i class="fa fa-user" aria-hidden="true"></i>
            </a>
        </li>
        <li class="scroll-to-section">
            <a href="{{ route('register') }}"
               data-toggle="tooltip" data-placement="top" title="Register">
                <i class="fa fa-user-plus" aria-hidden="true"></i>
            </a>
        </li>
    @endif
</ul>
