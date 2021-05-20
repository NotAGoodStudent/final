
@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/loginStyle.css') }}" rel="stylesheet">
    <div class="m-auto">
        <div class="card">
            <form class="box" method="post" id="form" action="{{ route('register') }}">
                @csrf
                <h1>Register</h1>
                <p class="text-muted">Create a new user!</p>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus placeholder="Surname">
                @error('surname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                @error('email')
                <span class="invalid-feedback" role="alert" id="emAlert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re-enter password">
                <input type="number" name="age" id="age" placeholder="age">
                <label for="gender">My gender is:</label>
                <select name="gender" id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <br>
                <a class="forgot text-muted" href={{ route('login') }}>Already have an account?</a>
                <input type="submit" value="Register">
                <div class="col-md-12">
                    <ul class="social-network social-circle">
                        <li><a href="#" class="icoFacebook" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" class="icoTwitter" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" class="icoGoogle" title="Google +"><i class="fab fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>

@endsection
