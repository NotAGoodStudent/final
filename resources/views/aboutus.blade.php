@extends('layouts.inapplayout')

@section('content')
    <link href="{{ asset('css/aboutusStyle.css') }}" rel="stylesheet">
    <div class="content">
        <header class="title">
            <h1>ABOUT DASHCUBE</h1>
        </header>
    <section>
        <div class="note m-auto">
            <div class="block1">
                <h3>WHO WE ARE</h3>
                <p>We're the best dating app out there simple as that... at least clients say so. Thanks to our experience we're able to bring to every single client what they are looking for, before you doubt our words please try us out. Love is complicated to find but we make it a little bit easier ;)</p>
            </div>
            <div class="block2">
                <h5>WHY SHOULD YOU TRUST US</h5>
                <p>Well in the first place if you're here that means that you are looking for love and that's our field, so why would you not trust our more than 100 workers specialized in bringing you the person you need? We work hard so it is easier for you to find love!
                <br> Why are you here still? join our community and find the person you need</p>
            </div>
            <div class="block3">
                <button class="">Join!</button>
            </div>
        </div>
    </section>
    <svg style="margin-top: -120px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ec9f05" fill-opacity="1" d="M0,32L40,32C80,32,160,32,240,69.3C320,107,400,181,480,213.3C560,245,640,235,720,202.7C800,171,880,117,960,85.3C1040,53,1120,43,1200,32C1280,21,1360,11,1400,5.3L1440,0L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
    </svg>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ec9f05" fill-opacity="1" d="M0,32L40,32C80,32,160,32,240,69.3C320,107,400,181,480,213.3C560,245,640,235,720,202.7C800,171,880,117,960,85.3C1040,53,1120,43,1200,32C1280,21,1360,11,1400,5.3L1440,0L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z"></path>
    </svg>
    <section id="team">
        <header class="title2">
            <h1 id="team_title">Meet the team</h1>
        </header>
        <div class="team d-flex justify-content-around">
            <div class="cardt">
                <img src="{{Storage::url('imgs/front/ceo.png')}}" alt="">
                <div class="team_footer">
                    <div class="name">
                        <h3>Stephen Donoghue</h3>
                    </div>
                    <div class="pos">
                        <h5>CEO</h5>
                    </div>
                </div>
            </div>
            <div class="cardt">
                <img src="{{Storage::url('imgs/front/manager1.png')}}" alt="">
                <div class="team_footer">
                    <div class="name">
                        <h3>El Xocas</h3>
                    </div>
                    <div class="pos">
                        <h5>Frontend designer</h5>
                    </div>
                </div>
            </div>
            <div class="cardt">
                <img class="img" src="{{Storage::url('imgs/front/manager2.jpg')}}" alt="">
                <div class="team_footer">
                    <div class="name">
                        <h3>Mr Jagger</h3>
                    </div>
                    <div class="pos">
                        <h5>Backend designer</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="up d-flex justify-content-center">
        <img class="img" id="up" style="width: 100px; float: right; " src="{{Storage::url('imgs/front/takemeup.png')}}" alt="">
    </div>
    </div>
    <script>

        var fired_once = false;
            $(window).scroll(function() {
                if ($(this).scrollTop() > $('#team').offset().top -900 && !fired_once) {
                    console.log('fired');
                    fired_once = true;
                    $('#team_title').slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
                    $('.cardt').each(function (x, img){
                        $(this).slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
                    });
                }
            });
        $('#up').click(function (){
            console.log('click')
            jQuery('html,body').animate({scrollTop:0},1000);
        });

    </script>

@endsection
