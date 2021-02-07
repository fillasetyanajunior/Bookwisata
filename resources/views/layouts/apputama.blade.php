<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('assets/utama/img/icon/icon.png')}}">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{url('assets/utama/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/slick.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{url('assets/utama/css/style.css') }}">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{url('assets/utama/img/icon/icon.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                    <div class="container">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-8">
                                <div class="header-info-left">
                                    <ul>
                                        <li>bookwista@bookwisata.com</li>
                                        <li><a href="">+62 274 - 443165 | WA +62 815-7913-168</a></li>
                                        <li>Yogyakarta</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="header-info-right f-right">
                                    <ul class="header-social">
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li> <a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-bottom  header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2 col-md-1">
                                <div class="logo">
                                    <a href="{{ url('/') }}"><img src="{{url('assets/utama/img/logo/Logo.jpg') }}" alt="" width="300px"></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10 col-md-10">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ url('/') }}">Home</a></li>
                                            <li><a href="{{ url('accomodasi/accomodasi') }}">Catagories</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ url('accomodasi/hotel') }}">Hotel</a></li>
                                                    <li><a href="{{ url('accomodasi/kuliner') }}">Kuliner</a></li>
                                                    <li><a href="{{ url('accomodasi/tour') }}">Tour Guide</a></li>
                                                    <li><a href="{{ url('accomodasi/pusat') }}">Pusat Oleh-Oleh</a></li>
                                                    <li><a href="{{ url('accomodasi/destinasi') }}">Destinasi</a></li>
                                                    <li><a href="{{ url('accomodasi/paket') }}">Paket Wisata</a></li>
                                                    <li><a href="{{ url('rental/mobil') }}">Mobil</a></li>
                                                    <li><a href="{{ url('rental/bus') }}">Bus Pariwisata</a></li>
                                                    <li><a href="{{ url('rental/kapal') }}">Kapal Pesiar</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                            <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

    <main>
        <!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div class="single-slider hero-overly  slider-height d-flex align-items-center" data-background="{{url('assets/utama/img/hero/h1_hero.jpg') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-9">
                                <div class="hero__caption">
                                    <h1>Find Where You want To Go</h1>
                                </div>
                            </div>
                        </div>
                        <!-- Search Box -->
                        <div class="row">
                            <div class="col-xl-12">
                                <!-- form -->
                                <form action="/" class="search-box" method="post">
                                    @csrf
                                    <div class="input-form mb-30">
                                        <input type="text" placeholder="When Would you like to go ?" name="pencarian" value="{{old('pencarian')}}">
                                    </div>
                                    <div class="search-form mb-30">
                                        <button type="submit" name="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            @if (session('status'))
                <div class="alert alert-secondary">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <!-- slider Area End-->

        @yield('main')
    </main>
          <footer>
            <!-- Footer Start-->
            <div class="footer-area footer-padding footer-bg" data-background="{{url('assets/utama/img/service/footer_bg.jpg') }}">
                <div class="container">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                            <div class="single-footer-caption mb-50">
                                <div class="single-footer-caption mb-30">
                                    <!-- logo -->
                                    <div class="footer-logo">
                                        <h1>Bookwisata Indonesia</h1>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p>Jl. Wonosari Km.7 Brojogaten Gg. Sukun No. 36 Banguntapan Bantul Daerah Istimewa Yogyakarta,Indonesia.
                                            <span>P: 24/7 customer support: +62 274 - 443165 | WA. +62 81 5791 3168</span> 
                                            <p>E: info@bookwisata.com</p></p> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Customer Support</h4>
                                    <ul>
                                        <li><a href="/home">Login</a></li>
                                        <li><a href="#">Layana Promosi Usaha</a></li>
                                        <li><a href="#">Cara Booking</a></li>
                                        <li><a href="#">FAQ</a></li>
                                        <li><a href="#">Contact</a></li>
                                        <li><a href="#">Lowongan Kerja</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>FolloW us</h4>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a>
                                    &nbsp;&nbsp;<a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    &nbsp;&nbsp;<a href="#"><i class="fab fa-facebook-f"></i></a>
                                    &nbsp;&nbsp;<a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                            <div class="single-footer-caption mb-50">
                                <div class="footer-tittle">
                                    <h4>Unduh Aplikasi Bookwisata</h4>
                                    <a href=""><img src="{{url('assets/utama/img/playstore.png') }}" alt="" width="200px"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer bottom -->
                    <div class="row pt-padding">
                        <div class="col-xl-7 col-lg-7 col-md-7">
                            <div class="footer-copy-right">
                                <p>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved by <a href="" target="_blank">Bookwisata.com</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </footer>


        <!-- JS here -->

        <!-- All JS Custom Plugins Link Here here -->
        <script src="{{url('assets/utama/js/vendor/modernizr-3.5.0.min.js') }}"></script>

        <!-- Jquery, Popper, Bootstrap -->
        <script src="{{url('assets/utama/js/jquery-3-5-1.js') }}"></script>
        <script src="{{url('assets/utama/js/popper.min.js') }}"></script>
        <script src="{{url('assets/utama/js/bootstrap.min.js') }}"></script>
        <!-- Jquery Mobile Menu -->
        <script src="{{url('assets/utama/js/jquery.slicknav.min.js') }}"></script>

        <!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{url('assets/utama/js/owl.carousel.min.js') }}"></script>
        <script src="{{url('assets/utama/js/slick.min.js') }}"></script>
        <!-- One Page, Animated-HeadLin -->
        <script src="{{url('assets/utama/js/wow.min.js') }}"></script>
        <script src="{{url('assets/utama/js/animated.headline.js') }}"></script>
        <script src="{{url('assets/utama/js/jquery.magnific-popup.js') }}"></script>

        <!-- Scrollup, nice-select, sticky -->
        <script src="{{url('assets/utama/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{url('assets/utama/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{url('assets/utama/js/jquery.sticky.js') }}"></script>

        <!-- contact js -->
        <script src="{{url('assets/utama/js/contact.js') }}"></script>
        <script src="{{url('assets/utama/js/jquery.form.js') }}"></script>
        <script src="{{url('assets/utama/js/jquery.validate.min.js') }}"></script>
        <script src="{{url('assets/utama/js/mail-script.js') }}"></script>
        <script src="{{url('assets/utama/js/jquery.ajaxchimp.min.js') }}"></script>

        <!-- Jquery Plugins, main Jquery -->
        <script src="{{url('assets/utama/js/plugins.js') }}"></script>
        <script src="{{url('assets/utama/js/main.js') }}"></script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/601fb04ec31c9117cb769f2a/1etttkinh';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
        

</body>

</html>
