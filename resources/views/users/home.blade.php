@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/homeStyle.css') }}" rel="stylesheet">
@if(auth()->user()->interested_in == null)
    <h5 style="text-align: center">Hi {{auth()->user()->name}}</h5>
    <p style="text-align: center">Please let us know more about <span><a href="{{route('updateProfile')}}" style="">you</a></span> before you get started</p>
@else
    <div class="partners m-auto mt-5">
            @foreach($users as $u)
                @if(count($u->given_likes) > 0)
                    @foreach($u->given_likes as $l)
                        @foreach($u->given_match as $m)
                            @if($l->like_receiver == auth()->user()->id)
                                @php
                                    $is_liked = true;
                                @endphp
                            @endif
                            @if($m->matched == auth()->user()->id)
                                @php
                                    $is_matched = true;
                                @endphp
                                @endif
                            @if(!$is_liked && !$is_matched)
                                    <div class="cardd">
                                        <img src="" alt="">
                                        <div class="cardd_footer">
                                            <h5><strong>{{$u->name}},</strong> {{$u->age}}</h5>
                                            <p>{{$u->location}}</p>
                                            <p>{{$u->bio}}</p>
                                        </div>
                                    </div>
                                @endif
                        @endforeach
                    @endforeach
                    @else
                <div class="cardd m-auto">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/06/Candice-Swanepoel_2010-03-31_VictoriasSecretStoreChicago_photo-by-Adam_Bielawski.jpg" style="" alt="">
                    <div class="cardd_footer">
                        <h3><strong>{{$u->name}}</strong> {{$u->age}}</h3>
                        <h5>{{$u->location}}</h5>
                        <h5>{{$u->bio}}</h5>
                    </div>
                    <div class="icons m-auto d-flex justify-content-between">
                        <a href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a>
                        <a href="#"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a>
                    </div>
                </div>
                @endif
            @endforeach
    </div>
@endif
@endsection
