@extends('layouts.inapplayout')

@section('content')
    <link href="{{ asset('css/welcomeStyle.css') }}" rel="stylesheet">
    <div class="content">
        <header class="masthead text-center text-white">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">Not finding love yet?</h1>
                    <h2 class="masthead-subheading mb-0">You came to the right place</h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">Learn More</a>
                </div>
            </div>
            <div class="bg-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
            <div class="bg-circle-4 bg-circle"></div>
        </header>
        <!-- Content section 1-->
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid" style="border-radius: 25px" src="{{Storage::url('imgs/front/img1.jpg')}}" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">We'll show you how to present yourself</h2>
                            <p>Don't know how to present yourself? well let us show you. Pick your best 3 pictures and upload them along with a bio and let us know in what you're interested in... We'll do the rest!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 2-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid" src="{{Storage::url('imgs/front/orangeheart.png')}}" alt="..." /></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <h2 class="display-4">Like, get likes and maybe match!</h2>
                            <p>Once you've set up your profile is where the fun begins. Based on your personal taste, we'll show you people and you'll decide whether you like them or not!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 3-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid"  style="border-radius: 25px" src="{{Storage::url('imgs/front/couple.jpg')}}" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-5">
                            <h2 class="display-4">Chat with people you've matched with!</h2>
                            <p>There's no better way to getting to know someone than by talking to them so... Once you've matched don't be shy and make the first step!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
