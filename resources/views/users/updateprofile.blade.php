@extends('layouts.app')
<link href="{{ asset('css/updateprofileStyle.css') }}" rel="stylesheet">
@section('content')
    <div class="update_data">
        <form action="{{route('updateUserData')}}" method="post" enctype="multipart/form-data" id="form" class="m-auto" style="margin: 0; width: 500px">
            @csrf
            @method('PATCH')
            @if($pictures != null)
                @php
                    $photo1_found = false;
                    $photo2_found = false;
                    $photo3_found = false;
                @endphp
                @if(count($pictures) > 0)
                     <div class="imgs_div d-flex justify-content-around">
                        @foreach($pictures as $p)
                            @if(strpos($p->picture_path, 'photo1'))
                                 @php
                                     $photo1_found = true;
                                 @endphp
                                <img class="imgs_set" id="photo1_space" title="Add a photo!" src="{{Storage::url($p->picture_path)}}" alt="">
                                <input type="file" id="photo1" name="photo1" hidden>
                             @elseif(strpos($p->picture_path, 'photo2'))
                                 <img class="imgs_set" id="photo2_space" title="Add a photo!" src="{{Storage::url($p->picture_path)}}" alt="">
                                 <input type="file" id="photo2" name="photo2" hidden>
                                 @php
                                     $photo2_found = true;
                                 @endphp
                             @elseif(strpos($p->picture_path, 'photo3'))
                                 <img class="imgs_set" id="photo3_space" title="Add a photo!" src="{{Storage::url($p->picture_path)}}" alt="">
                                 <input type="file" id="photo3" name="photo3" hidden>
                                 @php
                                     $photo3_found = true;
                                 @endphp
                             @endif
                        @endforeach
                        @if(!$photo1_found)
                                <img class="imgs" id="photo1_space" title="Add a photo!" src="{{Storage::url('/imgs/front/addImgDefault.png')}}" alt="">
                                <input type="file" id="photo1" name="photo1" hidden>
                            @endif
                        @if(!$photo2_found)
                                <img class="imgs" id="photo2_space" title="Add a photo!" src="{{Storage::url('/imgs/front/addImgDefault.png')}}" alt="">
                                <input type="file" id="photo2" name="photo2" hidden>
                            @endif
                        @if(!$photo3_found)
                                <img class="imgs" id="photo3_space" title="Add a photo!" src="{{Storage::url('/imgs/front/addImgDefault.png')}}" alt="">
                                <input type="file" id="photo3" name="photo3" hidden>
                            @endif

                    </div>
                @else
                    <div class="imgs_div d-flex justify-content-around">
                        <img class="imgs" id="photo1_space" title="Add a photo!" src="{{Storage::url('/imgs/front/addImgDefault.png')}}" alt="">
                        <input type="file" id="photo1" name="photo1" hidden>
                        <img class="imgs" id="photo2_space" title="Add a photo!" src="{{Storage::url('/imgs/front/addImgDefault.png')}}" alt="">
                        <input type="file" id="photo2" name="photo2" hidden>
                        <img class="imgs" id="photo3_space" title="Add a photo!" src="{{Storage::url('/imgs/front/addImgDefault.png')}}" alt="">
                        <input type="file" id="photo3" name="photo3" hidden>
                    </div>     <div class="imgs_div d-flex justify-content-around">
                        <img class="imgs" id="photo1_space" title="Add a photo!" src="{{Storage::url('/imgs/front/addImgDefault.png')}}" alt="">
                        <input type="file" id="photo1" name="photo1" hidden>
                        <img class="imgs" id="photo2_space" title="Add a photo!" src="{{Storage::url('/imgs/front/addImgDefault.png')}}" alt="">
                        <input type="file" id="photo2" name="photo2" hidden>
                        <img class="imgs" id="photo3_space" title="Add a photo!" src="{{Storage::url('/imgs/front/addImgDefault.png')}}" alt="">
                        <input type="file" id="photo3" name="photo3" hidden>
                    </div>
                @endif
            <div class="sensitive_data m-auto">
                <label for="name">Name </label>
                <input type="text" name="name" id="name" value="{{auth()->user()->name}}">
                <label for="surname">Surname </label>
                <input type="text" name="surname" id="surname" value="{{auth()->user()->surname}}">
                <label for="email">Email </label>
                <input type="email" name="email" id="email" value="{{auth()->user()->email}}">
                @if(auth()->user()->bio == null)
                    <label for="bio">Bio </label>
                    <textarea id="bio" name="bio" class="txt-area mx-auto d-block" placeholder="Add a bio!"></textarea>
                    @else
                    <label for="bio">Bio </label>
                    <textarea id="bio" name="bio" class="txt-area mx-auto d-block">{{auth()->user()->bio}}</textarea>
                @endif
                <label for="interested_in">Interested in</label>
                @if(auth()->user()->interested_in == null)
                    <select name="interested_in" id="interested_in" class="interested_in" id="interested_in">
                        <option value="Male">Men</option>
                        <option value="Female">Women</option>
                        <option value="Both">Men & Womem</option>
                        <option value="Other">Other</option>
                    </select>
                @else
                    @if(auth()->user()->interested_in == 'Male')
                    <select name="interested_in" id="interested_in" class="interested_in" id="interested_in">
                        <option value="Male">Men</option>
                        <option value="Female">Women</option>
                        <option value="Both">Men & Womem</option>
                        <option value="Other">Other</option>
                    </select>
                    @elseif(auth()->user()->interested_in == 'Female')
                        <select name="interested_in" id="interested_in" class="interested_in" id="interested_in">
                            <option value="Female">Women</option>
                            <option value="Male">Men</option>
                            <option value="Both">Men & Womem</option>
                            <option value="Other">Other</option>
                        </select>
                        @elseif(auth()->user()->interested_in == 'Both')
                        <select name="interested_in" id="interested_in" class="interested_in" id="interested_in">
                            <option value="Both">Men & Womem</option>
                            <option value="Female">Women</option>
                            <option value="Male">Men</option>
                            <option value="Other">Other</option>
                        </select>
                    @elseif(auth()->user()->interested_in == 'Other')
                        <select name="interested_in" id="interested_in" class="interested_in" id="interested_in">
                            <option value="Other">Other</option>
                            <option value="Both">Men & Womem</option>
                            <option value="Female">Women</option>
                            <option value="Male">Men</option>
                        </select>
                    @endif
                @endif
                <label for="age">Age</label>
                <input type="number" id="age" name="age" value="{{auth()->user()->age}}">
                <input type="submit" class="buttonSub" value="Update">
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {


            $('#photo1_space').click(function (){
                $('#photo1').click();
            });

            $('#photo2_space').click(function (){
                $('#photo2').click();
            });

            $('#photo3_space').click(function (){
                $('#photo3').click();
            });




            $('#form').validate({
                rules: {
                    name: {
                        required: true
                    },
                    surname: {
                        required: true
                    },

                    email:{
                        required: true
                    },

                    interested_in:{
                        required: true
                    },

                    age:{
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "This field is required",
                    },
                    surname: {
                        required: "This field is required",
                    },

                    email:{
                        required: "This field is required",
                    },

                    interested_in:{
                        required: "This field is required",
                    },

                    age:{
                        required: "This field is required",
                    }
                },
                errorPlacement: function(error, element) {
                    $(element).css('border:', 'red');
                },
            });
        });
    </script>
@endsection
