<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <title>@yield('title')</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-hexashop.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/lightbox.css') }}">
</head>

<body>

<!-- ***** Preloader Start ***** -->
{{--<div id="preloader">--}}
{{--    <div class="jumper">--}}
{{--        <div></div>--}}
{{--        <div></div>--}}
{{--        <div></div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('home') }}" class="logo">
                        <img src="{{ asset('assets/images/kidlet-desktop-logo-small.png') }}">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <a href="{{ route('home') }}" class="{{ Route::is('home') ? 'active' : '' }}">
                                Home
                            </a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="{{ route('category', ['categoryId' => 'womens']) }}"
                               class="{{ Route::is('category') && Request::segment(1) === 'womens' ? 'active' : '' }}"
                            >Women's</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="{{ route('category', ['categoryId' => 'mens']) }}"
                               class="{{ Route::is('category') && Request::segment(1) === 'mens' ? 'active' : '' }}"
                            >Men's</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="{{ route('category', ['categoryId' => 'kids']) }}"
                               class="{{ Route::is('category') && Request::segment(1) === 'kids' ? 'active' : '' }}"
                            >Kid's</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="{{ route('allProducts') }}" class="{{ Route::is('allProducts') ? 'active' : '' }}">
                                Explore All
                            </a>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->

@yield('banner')

@yield('content')

<!-- ***** Footer Start ***** -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="first-item">
                    <div class="logo">
                        <img src="{{ asset('assets/images/kidlet-desktop-logo-small.png') }}" alt="kidlet ecommerce templatemo">
                    </div>
                    <ul>
                        <li><a href="#">Romania, Keresztur</a></li>
                        <li><a href="#">kidlet@company.com</a></li>
                        <li><a href="#">010-020-0340</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <h4>Shopping &amp; Categories</h4>
                <ul>
                    <li><a href="{{ route('category', ['categoryId' => 'mens']) }}">Men’s Shopping</a></li>
                    <li><a href="{{ route('category', ['categoryId' => 'womens']) }}">Women’s Shopping</a></li>
                    <li><a href="{{ route('category', ['categoryId' => 'kids']) }}">Kid's Shopping</a></li>
                    <li><a href="{{ route('category', ['categoryId' => 'accessories']) }}">Accessories</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="under-footer">
                    <p>Copyright © 2022 Kidlet Co., Ltd. All Rights Reserved.

                        <br>Design: <a href="https://templatemo.com" target="_parent" title="free css templates">TemplateMo</a>
                    </p>
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>

<!-- Bootstrap -->
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/accordions.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/scrollreveal.min.js') }}"></script>
<script src="{{ asset('assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/js/imgfix.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.js') }}"></script>
<script src="{{ asset('assets/js/lightbox.js') }}"></script>
<script src="{{ asset('assets/js/isotope.js') }}"></script>

<!-- Global Init -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

<script>

    $(function () {
        var selectedClass = "";
        $("p").click(function () {
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("." + selectedClass).fadeOut();
            setTimeout(function () {
                $("." + selectedClass).fadeIn();
                $("#portfolio").fadeTo(50, 1);
            }, 500);

        });
    });

</script>

</body>
</html>
