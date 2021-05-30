<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <img class="logo" src="{{Storage::url('imgs/front/logo.png')}}" style="height: 50px" alt="">
                <!-- Windows-->
                @if(auth()->check())
                    <a class="navbar-brand" href="{{route('home')}}" style="margin-left: 10px">DashCube</a>
                @else
                    <a class="navbar-brand" href="{{route('index')}}" style="margin-left: 10px">DashCube</a>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(auth()->check())
                            <li class="nav-item">
                                <a class="nav-link" style="color: black" href="{{ route('matches') }}">Matches</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="color: black" href="{{ route('likes') }}">Likes</a>
                            </li>
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{route('updateProfile')}}">
                                        <span class="icon">
                                        <i class="fas fa-user-circle" style="color:orange;font-weight: bold; margin-right: 3px"></i>
                                        </span>Edit profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <span class="icon">
                                        <i class="fas fa-sign-out-alt text-danger" style="font-weight: bold; margin-right: 3px"></i>
                                        </span>{{ __('Logout') }}</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
<!--    <div class="fixed-bottom">
        <section class="contact-area" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="contact-content text-center">

                            <div class="contact-social">
                                <ul>
                                    <li><a class="hover-target" href=""><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="hover-target" href=""><i class="fab fa-linkedin-in"></i></a></li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        &lt;!&ndash; =============== 1.9 Contact Area End ====================&ndash;&gt;
        &lt;!&ndash; =============== 1.9 Footer Area Start ====================&ndash;&gt;
        <footer>
            <p>Copyright &copy; 2019 <img src="https://i.ibb.co/QDy827D/ak-logo.png" alt="logo"> All Rights Reserved.</p>
        </footer>
    </div>-->

</body>
<!--<style>

    section {
        padding: 60px 0;
        /* min-height: 100vh;*/
    }
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }
    .contact-area {
        border-bottom: 1px solid #353C46;
    }

    .contact-content p {
        font-size: 15px;
        margin: 30px 0 60px;
        position: relative;
    }

    .contact-content p::after {
        background: white   ;
        bottom: -30px;
        content: "";
        height: 1px;
        left: 50%;
        position: absolute;
        transform: translate(-50%);
        width: 80%;
    }

    .contact-content h6 {
        color: #8b9199;
        font-size: 15px;
        font-weight: 400;
        margin-bottom: 10px;
    }

    .contact-content span {
        color: #353c47;
        margin: 0 10px;
    }

    .contact-social {
        margin-top: 30px;
    }

    .contact-social > ul {
        display: inline-flex;
    }

    .contact-social ul li a {
        border: 1px solid black;
        color: black;
        display: inline-block;
        height: 40px;
        margin: 0 10px;
        padding-top: 7px;
        transition: all 0.4s ease 0s;
        width: 40px;
    }

    .contact-social ul li a:hover {
        border: 1px solid #FAB702;
        color: #FAB702;
    }

    .contact-content img {
        max-width: 210px;
    }

    section, footer {
        background: white;
        color: black;
    }

    footer p {
        padding: 40px 0;
        text-align: center;
    }

    footer img {
        width: 44px;
    }
</style>-->
</html>
