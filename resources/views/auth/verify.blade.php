@extends('layouts.app')

@section('content')
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-85 p-b-20">
                <span class="login100-form-title p-b-70">
                    Verification Your Email Address
                </span>
                @if (session('status'))
                    <div class="alert-success">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @else
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                @endif
			</div>
		</div>
	</div>
@endsection
