@extends('layouts.app')

@section('content')
@if(auth()->user()->interested_in == null)
    <h5 style="text-align: center">Hi {{auth()->user()->name}}</h5>
    <p style="text-align: center">Please let us know more about <span><a href="{{route('updateProfile')}}" style="">you</a></span> before you get started</p>
@else
    <div class="partners m-auto mt-5">

        @foreach($users as $u)
            @foreach($u->likes as $l)
                @foreach($u->matches as $m)
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
                            <div class="card">
                                <div class="d-inline-block">

                                </div>
                            </div>
                        @endif
                @endforeach
            @endforeach
        @endforeach
    </div>
@endif
@endsection
