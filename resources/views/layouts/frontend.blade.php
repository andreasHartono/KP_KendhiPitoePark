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

</head>

<body>

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
                                <a href="{{ url('/') }}"><img width="110px" height="110px"
                                        src="{{ asset('template/assets/images/pitoe.png') }}" alt="Logo"></a>
                            </div>
                            <!-- desktop logo Ends -->
                        </div>
                        <div class="col-3">
                            <!-- navbar cart start -->
                            <div class="navbar-cart">
                                <a class="icon-btn primary-icon-text icon-text-btn" href="javascript:void(0)">
                                    <img src="{{ asset('template/assets/images/icon-svg/cart-1.svg') }}"
                                        alt="Icon">
                                    <span class="icon-text text-style-1">1</span>
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
                                                                $total += $details['price'] * $details['quantity'];
                                                            @endphp
                                                            <tr>
                                                                <td class="checkout-product">
                                                                    <div class="product-cart d-flex">
                                                                        <div class="product-thumb">
                                                                            <img src="{{ asset('images/' . $details['image']) }}"
                                                                                alt="Product" />
                                                                        </div>
                                                                        <div class="product-content media-body">
                                                                            <h5 class="title">
                                                                                <a
                                                                                    href="product-details-page.html">{{ $details['name'] }}</a>
                                                                            </h5>
                                                                            <ul>
                                                                                <li>
                                                                                    <a class="delete"
                                                                                        href="javascript:void(0)">
                                                                                        <i class="mdi mdi-delete"></i>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="checkout-price">
                                                                    <p class="price">Rp.{{ $details['price'] }}</p>
                                                                </td>
                                                                <td class="checkout-quantity">
                                                                    <div class="product-quantity d-inline-flex">
                                                                        <button type="button" id="sub"
                                                                            class="sub">
                                                                            <i class="mdi mdi-minus"></i>
                                                                        </button>
                                                                        <input type="text"
                                                                            value="{{ $details['quantity'] }}">
                                                                        <button type="button" id="add"
                                                                            class="add">
                                                                            <i class="mdi mdi-plus"></i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                                <td class="checkout-price">
                                                                    <p class="price">
                                                                        Rp.{{ $details['price'] * $details['quantity'] }}
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="checkout-footer">
                                                <div class="checkout-sub-total d-flex justify-content-between">
                                                    <p class="value">Subtotal Price:</p>
                                                    <p class="price">Rp.{{ $total }}</p>
                                                </div>
                                                <div class="checkout-btn">
                                                    <a href="{{ url('cart') }}"
                                                        class="main-btn primary-btn-border">View
                                                        Cart</a>
                                                    <a href="{{ route('checkout') }}" class="main-btn primary-btn">Checkout</a>
                                                </div>
                                            </div>
                                        @endif
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
                                <a href="/"><img width="110px" height="110px"
                                        src="{{ asset('template/assets/images/pitoe.png') }}" alt="Logo"></a>
                            </div>
                            <!-- desktop logo Ends -->
                            <!-- navbar menu Start -->
                            <div class="navbar-menu">
                                <ul class="main-menu">
                                    @guest
                                        <a class="btn btn-success"
                                            href=" {{ route('login') }}"><img src="{{ asset('template/assets/images/person-circle.svg') }}"
                                            alt="Icon">&nbsp;&nbsp;Silahkan
                                            Login atau Register</a>
                                    @endguest
                                    @auth
                                       <li><p>Selamat Datang di Kendhi Pitoe, {{ Auth::user()->name }}</p></li>
                                       <li><a href="{{ url('profile') }}">Profil</a></li>
                                       <li><a href="{{ url('lacakpesanan') }}">Lacak Pesanan saya</a></li>
                                       <li><a href="{{ url('membershiptopup') }}">Kendhi Pitoe E-Wallet</a></li>
                                       <li><a href="{{ url('logout') }}">Logout</a></li>  
                                    @endauth
                                </ul>
                            </div>
                            <!-- navbar menu Ends -->
                            <div class="navbar-search-cart d-none d-lg-flex">
                                <!-- navbar cart start -->
                                <div class="navbar-cart">
                                    <a class="icon-btn primary-icon-text icon-text-btn" href="javascript:void(0)">
                                        <img src="{{ asset('template/assets/images/icon-svg/cart-1.svg') }}"
                                            alt="Icon">
                                        <span class="icon-text text-style-1">1</span>
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
                                                                    $total += $details['price'] * $details['quantity'];
                                                                @endphp
                                                                <tr>
                                                                    <td class="checkout-product">
                                                                        <div class="product-cart d-flex">
                                                                            <div class="product-thumb">
                                                                                <img src="{{ asset('images/' . $details['image']) }}"
                                                                                    alt="Product" />
                                                                            </div>
                                                                            <div class="product-content media-body">
                                                                                <h5 class="title">
                                                                                    <a
                                                                                        href="product-details-page.html">{{ $details['name'] }}</a>
                                                                                </h5>
                                                                                <ul>
                                                                                    <li>
                                                                                        <a class="delete"
                                                                                            href="javascript:void(0)">
                                                                                            <i
                                                                                                class="mdi mdi-delete"></i>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="checkout-price">
                                                                        <p class="price">Rp.{{ $details['price'] }}
                                                                        </p>
                                                                    </td>
                                                                    <td class="checkout-quantity">
                                                                        <div class="product-quantity d-inline-flex">
                                                                            <button type="button" id="sub"
                                                                                class="sub">
                                                                                <i class="mdi mdi-minus"></i>
                                                                            </button>
                                                                            <input type="text"
                                                                                value="{{ $details['quantity'] }}">
                                                                            <button type="button" id="add"
                                                                                class="add">
                                                                                <i class="mdi mdi-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                    </td>
                                                                    <td class="checkout-price">
                                                                        <p class="price">
                                                                            Rp.{{ $details['price'] * $details['quantity'] }}
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="checkout-footer">
                                                    <div class="checkout-sub-total d-flex justify-content-between">
                                                        <p class="value">Subtotal Price:</p>
                                                        <p class="price">Rp.{{ $total }}</p>
                                                    </div>
                                                    <div class="checkout-btn">
                                                        <a href="{{ url('cart') }}"
                                                            class="main-btn primary-btn-border">View
                                                            Cart</a>
                                                        <a href="{{ url('checkout') }}"
                                                            class="main-btn primary-btn">Checkout</a>
                                                    </div>
                                                </div>
                                            @endif
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
    <section class="footer-style-3 pt-100 pb-100">
        <div class="container">
            <div class="footer-top">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7 col-sm-10">
                        <div class="footer-logo text-center">
                            <a href="/">
                                <img height="150px" width="150px"
                                    src="{{ asset('template/assets/images/pitoe.png') }}" alt="">
                            </a>
                        </div>
                        <h5 class="heading-5 text-center mt-30">Follow Us</h5>
                        <ul class="footer-follow text-center">
                            <li><a href="javascript:void(0)"><i class="lni lni-instagram-original"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="lni lni-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-copyright text-center">
                <p>Developed by Universitas Surabaya & <a href="https://graygrids.com/" rel="nofollow"
                        target="_blank">GrayGrids</a>. Basesd on <a href="https://ecommercehtml.com/" rel="nofollow"
                        target="_blank">eCommerceHTML</a>
                </p>
            </div>
    </section>
    <!--====== Footer Style 3 Part Ends ======-->
    @yield('javascript')
    <!--====== Bootstrap 5 js ======-->
    <script src="{{ asset('template/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/bootstrap.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
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

    <!--====== Main js ======-->
    <script src="{{ asset('template/assets/js/main.js') }}"></script>

</body>

</html>
