<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">

    <!--====== Title ======-->
    <title>Kendhi Pitoe Cafe</title>

    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ asset('template/assets/images/pitoe.png') }}" type="image/png">

    <!--====== Slick CSS ======-->
    <link rel="stylesheet" href="{{ asset('template/assets/css/slick.css') }}">

    <!--====== Line Icons CSS ======-->
    <link rel="stylesheet" href="{{ asset('template/assets/css/LineIcons.css') }}">

    <!--====== Material Design Icons CSS ======-->
    <link rel="stylesheet" href="{{ asset('template/assets/css/materialdesignicons.min.css') }}">

    <!--====== Jquery Ui CSS ======-->
    <link rel="stylesheet" href="{{ asset('template/assets/css/jquery-ui.min.css') }}">

    <!--====== nice select CSS ======-->
    <link rel="stylesheet" href="{{ asset('template/assets/css/nice-select.css') }}">

    <!--====== Bootstrap CSS ======-->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}">

    <!--====== Default CSS ======-->
    <link rel="stylesheet" href="{{ asset('template/assets/css/default.css') }}">

    <!--====== Style CSS ======-->
    <link rel="stylesheet" href="{{ asset('template/assets/css/style.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    @yield('css')
    @laravelPWA
</head>

<body>
    @php
        $total = 0;
        $total1 = 0;
    @endphp
    @include('sweetalert::alert')

    <!--====== Preloader Part Start ======-->
    <div class="preloader">
        <div class="loader">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== Preloader Part Ends ======-->

    <!--====== Navbar Style 7 Part Start ======-->
    <div class="navigation">
        <header class="navbar-style-7 position-relative">
            <div class="container">
                <!-- navbar mobile Start -->
                <div class="navbar-mobile d-lg-none">
                    <div class="row align-items-center">
                        <div class="col-3">
                            <!-- navbar cart start -->
                            <div class="navbar-toggle icon-text-btn">
                                <a class="icon-btn primary-icon-text mobile-menu-open-7" href="javascript:void(0)">
                                    <i class="mdi mdi-menu"></i>
                                </a>
                            </div>
                            <!-- navbar cart Ends -->
                        </div>
                        <div class="col-6">
                            <!-- desktop logo Start -->
                            <div class="mobile-logo text-center">
                                <a href="{{ route('index') }}"><img width="110px" height="110px"
                                        src="{{ asset('template/assets/images/pitoe.png') }}" alt="Logo"></a>
                            </div>
                            <!-- desktop logo Ends -->
                        </div>

                        <div class="col-3">
                            <!-- navbar cart start -->

                            <div class="navbar-cart">

                                <a class="icon-btn primary-icon-text icon-text-btn" href="javascript:void(0)">
                                    <img src="{{ asset('template/assets/images/icon-svg/cart-9.svg') }}"
                                        alt="Icon">
                                    @if (session('cart'))
                                        <span class="icon-text text-style-1">{{ count(session('cart')) }}</span>
                                    @endif
                                </a>

                                <div class="navbar-cart-dropdown">
                                    <div class="checkout-style-2">
                                        <div class="checkout-header d-flex justify-content-between">
                                            <h6 class="title">Daftar Pesanan Sementara</h6>

                                        </div>
                                        @if (session('cart'))
                                            <div class="checkout-table">
                                                <table class="table">
                                                    <tbody>
                                                        @foreach (session('cart') as $id => $details)
                                                            @php
                                                                $total1 += $details['price'] * $details['quantity'];
                                                            @endphp
                                                            <tr>
                                                                <td class="checkout-product">
                                                                    <div class="product-cart d-flex">
                                                                        <div class="product-content media-body">
                                                                            <h5 class="title">{{ $details['name'] }}
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="checkout-price">
                                                                    <p class="price">
                                                                        Rp.{{ number_format($details['price']) }}</p>
                                                                </td>
                                                                <td class="checkout-quantity">
                                                                    <div class="product-quantity d-inline-flex">
                                                                        {{-- <button type="button" id="sub"
                                                                            class="sub">
                                                                            <i class="mdi mdi-minus"></i>
                                                                        </button> --}}
                                                                        <input type="text"
                                                                            value="{{ $details['quantity'] }}">
                                                                        {{-- <button type="button" id="add"
                                                                            class="add">
                                                                            <i class="mdi mdi-plus"></i>
                                                                        </button> --}}
                                                                    </div>
                                                                </td>
                                                                <td class="checkout-price">
                                                                    <p class="price">
                                                                        Rp.{{ number_format($details['price'] * $details['quantity']) }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        <div class="checkout-footer">
                                                <div class="checkout-sub-total d-flex justify-content-between">
                                                    <p class="value">Grand Total :</p>
                                                    <p class="price">Rp.{{ number_format($total1) }}</p>
                                                </div>
                                                <div class="checkout-btn">
                                                    <a href="{{ route('cart') }}"
                                                        class="main-btn primary-btn-border">View
                                                        Cart</a>
                                                    <a href="{{ route('checkout') }}"
                                                        class="main-btn primary-btn">Checkout</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <!-- navbar cart Ends -->
                        </div>
                    </div>
                    <!-- navbar search start -->
                    <!-- navbar search Ends -->
                </div>
                <!-- navbar mobile Start -->
            </div>

            <div class="navbar-container navbar-sidebar-7">
                <!-- navbar close  Ends -->
                <div class="navbar-close d-lg-none">
                    <a class="close-mobile-menu-7" href="javascript:void(0)"><i class="mdi mdi-close"></i></a>
                </div>

                <!-- main navbar Start -->
                <div class="navbar-wrapper">
                    <div class="container-lg">
                        <nav class="main-navbar d-lg-flex justify-content-between align-items-center">
                            <!-- desktop logo Start -->
                            <div class="desktop-logo d-none d-lg-block">
                                <a href="{{ route('index') }}"><img width="110px" height="110px"
                                        src="{{ asset('template/assets/images/pitoe.png') }}" alt="Logo"></a>
                            </div>
                            <!-- desktop logo Ends -->
                            <!-- navbar menu Start -->
                            <div class="navbar-menu">
                                <ul class="main-menu">
                                    @guest
                                        <li><a class="btn btn-success" href=" {{ route('login') }}"><img
                                                    src="{{ asset('template/assets/images/person-circle.svg') }}"
                                                    alt="Icon">&nbsp;&nbsp;Silahkan
                                                Login atau Register</a></li>
                                        <li><a href="{{ route('lacak_pesanan_tamu') }}">Lacak Pesanan</a></li>
                                    @endguest
                                    @auth
                                        <li><a href="{{ route('index') }}">Menu</a></li>

                                        <li><a href="{{ route('lacak_pesanan') }}">Lacak Pesanan saya</a></li>
                                        <li><a href="{{ route('pelanggan_topup') }}">Kendhi Pitoe E-Wallet</a></li>
                                        <li class="menu-item-has-children">
                                            <a href="#">{{ Auth::user()->name }}</a>
                                            <!-- sub menu Start -->
                                            <ul class="sub-menu">
                                                <li><b>Selamat Datang di Kendhi Pitoe, {{ Auth::user()->name }}<b></li>
                                                <li><a href="{{ route('profil_pelanggan') }}">Profil</a></li>
                                                <li><a href="{{ route('pegawai') }}">Halaman Pegawai</a></li>
                                                <li><a href="{{ route('logout') }}">Logout</a></li>
                                            </ul>
                                            <!-- sub menu Ends -->
                                        </li>
                                    @endauth
                                </ul>
                            </div>
                            <!-- navbar menu Ends -->
                            <div class="navbar-search-cart d-none d-lg-flex">
                                <!-- navbar cart start -->
                                <div class="navbar-cart">
                                    <a class="icon-btn primary-icon-text icon-text-btn" href="javascript:void(0)">
                                        <img src="{{ asset('template/assets/images/icon-svg/cart-9.svg') }}"
                                            alt="Icon">
                                        @if (session('cart'))
                                            <span class="icon-text text-style-1">{{ count(session('cart')) }}</span>
                                        @endif
                                    </a>
                                    <div class="navbar-cart-dropdown">
                                        <div class="checkout-style-2">
                                            <div class="checkout-header d-flex justify-content-between">
                                                <h6 class="title">Daftar Pesanan Sementara</h6>
                                            </div>
                                            @if (session('cart'))
                                                <div class="checkout-table" id="cart_place">
                                                    <table class="table">
                                                        <tbody>
                                                            @foreach (session('cart') as $id => $details)
                                                                @php
                                                                    $total += $details['price'] * $details['quantity'];
                                                                @endphp
                                                                <tr>
                                                                    <td class="checkout-product">
                                                                        <div class="product-cart d-flex">
                                                                            <div class="product-content media-body">
                                                                                <h5 class="title">
                                                                                    {{ $details['name'] }}
                                                                                </h5>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="checkout-price">
                                                                        <p class="price">
                                                                            Rp.{{ number_format($details['price']) }}
                                                                        </p>
                                                                    </td>
                                                                    <td class="checkout-quantity">
                                                                        <!-- <div class="product-quantity d-inline-flex">
                                                                    <button type="button" id="sub" class="sub">
                                                                        <i class="mdi mdi-minus"></i>
                                                                    </button>
                                                                    <input type="text" value="{{ $details['quantity'] }}">
                                                                    <button type="button" id="add" class="add">
                                                                        <i class="mdi mdi-plus"></i>
                                                                    </button>
                                                                </div> -->
                                                                        <b>
                                                                            {{ $details['quantity'] }}
                                                                        </b>
                                                                    </td>
                                                                    <td class="checkout-price">
                                                                        <p class="price">
                                                                            Rp.{{ number_format($details['price'] * $details['quantity']) }}
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                @endif
                                                <div class="checkout-footer">
                                                    <div class="checkout-sub-total d-flex justify-content-between">
                                                        <p class="value">Grand Total:</p>
                                                        <p class="price">Rp.{{ number_format($total) }}</p>
                                                    </div>
                                                    <div class="checkout-btn">
                                                        <a href="{{ route('cart') }}"
                                                            class="main-btn primary-btn-border">View
                                                            Cart</a>
                                                        <a href="{{ route('checkout') }}"
                                                            class="main-btn primary-btn">Checkout</a>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- navbar cart Ends -->
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- main navbar Ends -->
            </div>
            <div class="overlay-7"></div>
        </header>
    </div>
    <!--====== Navbar Style 7 Part Ends ======-->

    <!--====== Product Style 7 Part Start ======-->
    <section class="product-wrapper pt-100 pb-100">
        @yield('content')
    </section>

    <!--====== Product Style 7 Part Ends ======-->

    <!--====== Footer Style 3 Part Start ======-->
    <section class="footer-style-3 pt-50 pb-50">
        <div class="container">
            <div class="footer-top">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7 col-sm-10">
                        <div class="footer-logo text-center">
                            <a href="/">
                                <img height="150px" width="150px"
                                    src="{{ asset('template/assets/images/pitoe.png') }}" alt="logo footer">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-copyright text-center">
                <p>Developed by Kendhi Pitoe Park Universitas Surabaya & <a href="https://graygrids.com/"
                        rel="nofollow" target="_blank">GrayGrids</a>. Basesd on <a href="https://ecommercehtml.com/"
                        rel="nofollow" target="_blank">eCommerceHTML</a>
                </p>
            </div>
    </section>
    <!--====== Footer Style 3 Part Ends ======-->
    @yield('javascript')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>>
    <!--====== Bootstrap 5 js ======-->
    <script src="{{ asset('template/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/bootstrap.min.js') }}"></script>

    <!--====== Jquery js ======-->
    <script src="{{ asset('template/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('template/assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>

    <!--====== Slick js ======-->
    <script src="{{ asset('template/assets/js/slick.min.js') }}"></script>

    <!--====== Accordion Steps Form js ======-->
    <script src="{{ asset('template/assets/js/jquery-vj-accordion-steps.js') }}"></script>

    <!--====== Jquery Ui js ======-->
    <script src="{{ asset('template/assets/js/jquery-ui.min.js') }}"></script>

    <!--====== Form validator js ======-->
    <script src="{{ asset('template/assets/js/jquery.form-validator.min.js') }}"></script>

    <!--====== nice select js ======-->
    <script src="{{ asset('template/assets/js/jquery.nice-select.min.js') }}"></script>

    <!--====== formatter js ======-->
    <script src="{{ asset('template/assets/js/jquery.formatter.min.js') }}"></script>

    <!--====== Main js ======-->
    <script src="{{ asset('template/assets/js/count-up.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <!--====== Main js ======-->
    <script src="{{ asset('template/assets/js/main.js') }}"></script>
    <script>
        function refreshCart() {
            $("#cart_nav").load(window.location.href + "#cart_nav");
        }

        // Initialize the service worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register({{ public_path('/serviceworker.js') }}, {
                scope: '.'
            }).then(function(registration) {
                // Registration was successful
                console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
            }, function(err) {
                // registration failed :(
                console.log('Laravel PWA: ServiceWorker registration failed: ', err);
            });
        }
    </script>

</body>

</html>
