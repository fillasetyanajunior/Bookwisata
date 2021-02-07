@extends('layouts.app')

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
					@csrf
					<span class="login100-form-title p-b-70">
						Welcome
                    </span>

                    @if ($errors->any())
                        <div class="alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

					<div class="wrap-input100 m-t-85 m-b-35 " >
						<input class="input100" type="text" name="email" value="{{old('email')}}" placeholder="Email">
					</div>

					<div class="wrap-input100 m-b-50 " >
						<input class="input100" type="password" name="password" placeholder="Password">
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<ul class="login-more p-t-190">
						<li class="m-b-8">
							<span class="txt1">
								Forgot
							</span>

							<a href="{{ route('password.request') }}" class="txt2">
								Username / Password?
							</a>
						</li>

						<li>
							<span class="txt1">
								Don’t have an account?
							</span>

							<a href="{{ route('register') }}" class="txt2">
								Sign up
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
@endsection
