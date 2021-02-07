@extends('layouts.app')

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
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

					<div class="wrap-input100 m-t-85 m-b-35" d>
						<input class="input100" type="text" name="name" placeholder="Name" value="{{old('name')}}">
                    </div>
                    
					<div class="wrap-input100 m-b-50 ">
						<input class="input100" type="text" name="email" placeholder="Email" value="{{old('email')}}">
                    </div>
                    
					<div class="wrap-input100 m-b-50 ">
						<input class="input100" type="text" name="nomer" placeholder="Nomer Hp" value="{{old('nomer')}}">
					</div>

					<div class="wrap-input100 m-b-50">
						<input class="input100" type="password" name="password" placeholder="Password">
                    </div>
                    
					<div class="wrap-input100 m-b-50 ">
						<input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password">
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Register
						</button>
					</div>

					<ul class="login-more p-t-190">
						<li class="m-b-8">
							<span class="txt1">
								if you already have account?
							</span>

							<a href="{{ route('login') }}" class="txt2">
								Login
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
@endsection


