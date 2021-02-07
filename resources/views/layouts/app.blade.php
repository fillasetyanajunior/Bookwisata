<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="shortcut icon" type="image/x-icon" href="{{url('assets/utama/img/icon/icon.png')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= url('assets/vendor/bootstrap/css/bootstrap.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= url('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= url('assets/fonts/iconic/css/material-design-iconic-font.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= url('assets/vendor/animate/animate.css')?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= url('assets/vendor/css-hamburgers/hamburgers.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= url('assets/vendor/animsition/css/animsition.min.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= url('assets/vendor/select2/select2.min.css')?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?= url('assets/vendor/daterangepicker/daterangepicker.css')?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?= url('assets/css/util.css')?>">
	<link rel="stylesheet" type="text/css" href="<?= url('assets/css/main.css')?>">
<!--===============================================================================================-->
</head>
<body>
    {{-- <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}

        @yield('content')

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="<?= url('assets/vendor/jquery/jquery-3.2.1.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= url('assets/vendor/animsition/js/animsition.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= url('assets/vendor/bootstrap/js/popper.js')?>"></script>
	<script src="<?= url('assets/vendor/bootstrap/js/bootstrap.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= url('assets/vendor/select2/select2.min.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= url('assets/vendor/daterangepicker/moment.min.js')?>"></script>
	<script src="<?= url('assets/vendor/daterangepicker/daterangepicker.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= url('assets/vendor/countdowntime/countdowntime.js')?>"></script>
<!--===============================================================================================-->
	<script src="<?= url('assets/js/main.js')?>"></script>

</body>
</html>
