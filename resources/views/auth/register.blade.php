
@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/registerStyle.css') }}" rel="stylesheet">
    <div class="container">
        <div class="login_container m-auto">
            <form class="formm" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="content d-flex justify-content-sm-center">
                    <img src="{{Storage::url('imgs/front/idk.jpg')}}">
                    <div class="inputs d-flex flex-column" >
                        <h3 style="text-align: center; padding-bottom: 20px">Sign up</h3>
                        <input id="name" style="margin-top: 20px" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <input id="surname" style="margin-top: 20px" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus placeholder="Surname">
                        @error('surname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <input id="email" style="margin-top: 20px" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                        @error('email')
                        <span class="invalid-feedback" role="alert" id="emAlert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                        <input id="password" style="margin-top: 20px" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                        @enderror
                        <input id="password_confirmation" style="margin-top: 20px" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter password">
                        <input type="number" class="form-control" style="margin-top: 20px" name="age" id="age" placeholder="age">
                        @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <select style="margin-top: 20px" class="form-control" name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <a class="forgot text-muted" style="margin-top: 20px" href={{ route('login') }}>Already have an account?</a>
                        <input type="submit" style="margin-top: 20px" value="Sign up">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
