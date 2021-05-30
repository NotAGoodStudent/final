@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/loginStyle.css') }}" rel="stylesheet">
<div class="container">
    <div class="login_container m-auto">
            <form class="formm" method="POST" action="{{ route('login') }}">
            @csrf
                <div class="content d-flex justify-content-sm-center">
                    <img src="{{Storage::url('imgs/front/idk.jpg')}}">
                    <div class="inputs d-flex flex-column">
                        <h3 style="text-align: center; padding-bottom: 20px">Sign in</h3>
                        <input style="" placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                        @enderror
                        <input style="margin-top: 20px" placeholder="Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                        @enderror
                        <a style="margin-top: 20px" class="forgot text-muted" href={{ route('register') }}>Don't have an account yet?</a>
                        <input style="margin-top: 20px" type="submit" value="Sign in">
                    </div>
                </div>
            </form>
    </div>
</div>
@endsection
