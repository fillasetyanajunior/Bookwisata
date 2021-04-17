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
                                            <li><a>Catagories</a>
                                                <ul class="submenu">
                                                    <li><a href="{{ route('listofhotel') }}">Hotel</a></li>
                                                    <li><a href="{{ route('listofkuliner') }}">Kuliner</a></li>
                                                    <li><a href="{{ route('listofguide') }}">Tour Guide</a></li>
                                                    <li><a href="{{ route('listofpusat') }}">Pusat Oleh-Oleh</a></li>
                                                    <li><a href="{{ route('listofdestinasi') }}">Destinasi</a></li>
                                                    <li><a href="{{ route('listofpaket') }}">Paket Wisata</a></li>
                                                    <li><a href="{{ route('listofmobil') }}">Mobil</a></li>
                                                    <li><a href="{{ route('listofbus') }}">Bus Pariwisata</a></li>
                                                    <li><a href="{{ route('listofkapal') }}">Kapal Pesiar</a></li>
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
                                        <button type="submit" class="btn btn-primary">Search</button>
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
            <!-- Video Start Arera -->
        <div class="video-area video-bg pt-200 pb-200"  data-background="{{url('assets/utama/img/service/video-bg.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="video-caption text-center">
                            <div class="video-icon">
                                <a class="popup-video" href="https://www.youtube.com/watch?v=1aP-TXUpNoU" tabindex="0"><i class="fas fa-play"></i></a>
                            </div>
                            <p class="pera1">Love where you re going in the perfect time</p>
                            <p class="pera2">Tripo is a World Leading Online</p>
                            <p class="pera3"> Tour Booking Platform</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Video Start End -->
        <!-- Support Company Start-->
        <div class="support-company-area support-padding fix">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="support-location-img mb-50">
                            <img src="{{url('assets/utama/img/service/support-img.jpg')}}" alt="">
                            <div class="support-img-cap">
                                <span>Since 1992</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="right-caption">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle2">
                                <span>About Our Company</span>
                                <h2>We are Go Trip <br>Ravels Support Company</h2>
                            </div>
                            <div class="support-caption">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</p>
                                <div class="select-suport-items">
                                    <label class="single-items">Lorem ipsum dolor sit amet
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="single-items">Consectetur adipisicing sed do
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="single-items">Eiusmod tempor incididunt
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="single-items">Ad minim veniam, quis nostrud.
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <a href="#" class="btn border-btn">About us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Support Company End-->
        <!-- Testimonial Start  -->
        <!-- Testimonial Start  -->
        <div class="testimonial-area testimonial-padding" data-background="{{url('assets/utama/img/testmonial/testimonial_bg.jpg')}}">
            <div class="container ">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-11 col-lg-11 col-md-9">
                        <div class="h1-testimonial-active">
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <div class="testimonial-top-cap">
                                        <img src="{{url('assets/utama/img/icon/testimonial.png')}}" alt="">
                                        <p>Logisti Group is a representative logistics operator providing full range of ser
                                            of customs clearance and transportation worl.</p>
                                    </div>
                                    <!-- founder -->
                                    <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                        <div class="founder-img">
                                            <img src=" {{url('assets/utama/img/testmonial/Homepage_testi.png')}}" alt="">
                                        </div>
                                        <div class="founder-text">
                                            <span>Jessya Inn</span>
                                            <p>Co Founder</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Testimonial -->
                            <div class="single-testimonial text-center">
                                <!-- Testimonial Content -->
                                <div class="testimonial-caption ">
                                    <div class="testimonial-top-cap">
                                        <img src="{{ url('assets/utama/img/icon/testimonial.png')}}" alt="">
                                        <p>Logisti Group is a representative logistics operator providing full range of ser
                                            of customs clearance and transportation worl.</p>
                                    </div>
                                    <!-- founder -->
                                    <div class="testimonial-founder d-flex align-items-center justify-content-center">
                                        <div class="founder-img">
                                            <img src="{{url('assets/utama/img/testmonial/Homepage_testi.png')}}" alt="">
                                        </div>
                                        <div class="founder-text">
                                            <span>Jessya Inn</span>
                                            <p>Founder</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
        <!-- Blog Area Start -->
        <div class="home-blog-area section-padding2">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Bookwisata</span>
                            <h3>Layanan Mitra</h3>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-place mb-30">
                            <center>
                                <div class="card text-white  mb-3" style="max-width: 18rem;">
                                    <div class="card-header bg-success"><h3>Trial Mitra</h3></div>
                                    <div class="card-body">
                                        <h4 class="card-title">Trial Mitra 30 Hari</h4>
                                        <p class="card-text" style="color: white">Trial</p>
                                        <p class="card-text">0</p>
                                        <form action="/layananmitra" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="5">
                                            <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                        </form>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-place mb-30">
                            <center>
                                <div class="card text-white  mb-3" style="max-width: 18rem;">
                                    <div class="card-header bg-success"><h3>Termurah</h3></div>
                                    <div class="card-body">
                                        <h4 class="card-title">Layanan 3 Bulan</h4>
                                        <p class="card-text" style="color: white">pemula</p>
                                        <p class="card-text">150.000.-/3 Bulan</p>
                                        <form action="/layananmitra" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="1">
                                            <input type="hidden" name="harga" value="150000">
                                            <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                        </form>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-place mb-30">
                            <center>
                                <div class="card text-white  mb-3" style="max-width: 18rem;">
                                    <div class="card-header bg-success"><h3>Diskon 30%</h3></div>
                                    <div class="card-body">
                                        <h4 class="card-title">Layanan 6 Bulan</h4>
                                        <p class="card-text"><s>400.000.-</s></p>
                                        <p class="card-text">280.000.-/6 Bulan</p>
                                        <form action="/layananmitra" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="2">
                                            <input type="hidden" name="harga" value="280000">
                                            <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                        </form>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-place mb-30">
                            <center>
                                <div class="card text-white  mb-3" style="max-width: 18rem;">
                                    <div class="card-header bg-success"><h3>Diskon 75%</h3></div>
                                    <div class="card-body">
                                        <h4 class="card-title">Layanan 2 Tahun</h4>
                                        <p class="card-text"><s>1.000.000.-</s></p>
                                        <p class="card-text">750.000.-/6 Bulan</p>
                                        <form action="/layananmitra" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="3">
                                            <input type="hidden" name="harga" value="750000">
                                            <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                        </form>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-place mb-30">
                            <center>
                                <div class="card text-white  mb-3" style="max-width: 18rem;">
                                    <div class="card-header bg-success"><h3>Diskon 50%</h3></div>
                                    <div class="card-body">
                                        <h4 class="card-title">Layanan 1 Tahun</h4>
                                        <p class="card-text"><s>1.000.000.-</s></p>
                                        <p class="card-text">500.000.-/Bln</p>
                                        <form action="/layananmitra" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="4">
                                            <input type="hidden" name="harga" value="500000">
                                            <button type="submit" class="btn btn-primary">Pilih Sekarang</button>
                                        </form>
                                    </div>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Blog Area End -->
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
                                        <h1 style="color: white;">Bookwisata Indonesia</h1>
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
                                        <li><a href="/login">Login</a></li>
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
