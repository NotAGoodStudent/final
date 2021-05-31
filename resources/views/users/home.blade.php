@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/homeStyle.css') }}" rel="stylesheet">
@if(auth()->user()->interested_in == null)
    <div class="center">
        <h1 style="text-align: center">Hi {{auth()->user()->name}}!</h1>
        <h5 style="text-align: center">Please let us know more about <span><a href="{{route('updateProfile')}}" style="">you</a></span> before you get started</h5>
        <img style="text-align: center" class="mt-5" src="{{Storage::url('imgs/front/orangeheart.png')}}" alt="">
    </div>
@else

    <div class="partners m-auto mt-5 justify-center" id="partners">
    </div>
    <div class="its_a_match m-auto mt-5" id="its_a_match">

    </div>
@endif
    <script>


        function nextPhoto(id){
            console.log('here');
            let img_path = $('#cardd'+id).find('img').attr('src');
            console.log(img_path);
            if(img_path.includes('photo1')){
                for(let x = 0; x< pictures.length;x++){
                    if(pictures[x].picture_path.includes('photo2') && pictures[x].user_id === id){
                        $('#cardd'+id).find('img').attr('src', 'http://localhost:3300/storage/'+pictures[x].picture_path);
                        break;
                    }
                }

            }
            else if(img_path.includes('photo2')){

                let not_found = false;
                for(let x = 0; x< pictures.length;x++){
                    if(pictures[x].picture_path.includes('photo3') && pictures[x].user_id === id){
                        $('#cardd'+id).find('img').attr('src', 'http://localhost:3300/storage/'+pictures[x].picture_path);
                        not_found = true;
                        break;
                    }
                }

                if(!not_found){
                    for(let x = 0; x< pictures.length;x++){
                        if(pictures[x].picture_path.includes('photo1') && pictures[x].user_id === id){
                            $('#cardd'+id).find('img').attr('src', 'http://localhost:3300/storage/'+pictures[x].picture_path);
                            not_found = true;
                            break;
                        }
                    }
                }


            }
            else if(img_path.includes('photo3')){

                for(let x = 0; x< pictures.length;x++){
                    if(pictures[x].picture_path.includes('photo1') && pictures[x].user_id === id){
                        $('#cardd'+id).find('img').attr('src', 'http://localhost:3300/storage/'+pictures[x].picture_path);
                        break;
                    }
                }
            }
        }

        function checkIfLiked(u){
            if(likes.length > 0){
                likes.forEach(function (l){
                    if(l.like_giver === {{auth()->user()->id}} && l.like_receiver === u.id){
                        return true;
                    }
                });
                return false;
            }
        }

        function checkIfMatched(u){
            if (matches.length > 0) {
                matches.forEach(function (m) {
                    if(m.matcher === {{auth()->user()->id}} && m.matched === u.id || m.matcher === u.id && m.matched ===  {{auth()->user()->id}}) {
                        return true
                    }
                });
                return false;
            }
            return false;

        }
        var likedUsers=[];
        var users;
        var pictures;
        var likes;
        var matches;
        $.ajax({
            //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
            url: 'http://localhost:3300/user/getHomeData',
            success: function (data) {
                console.log(data);
                users = data['users_clear'];
                pictures = data['pictures'];
                likes = data['likes'];
                matches = data['matches'];
                var added = false;
                    for (let x = 0; x < users.length;x++){
                        console.log(users[x].name);
                        var user_is_liked = false;
                        var user_is_matched = false;
                        for(let i = 0; i < pictures.length;i++) {
                            if(likes.length > 0){
                                likes.forEach(function (l){
                                    if(l.like_giver === {{auth()->user()->id}} && l.like_receiver === users[x].id){
                                        user_is_liked = true;
                                    }
                                });
                            }
                            if (matches.length > 0) {
                                matches.forEach(function (m) {
                                    if(m.matcher === {{auth()->user()->id}} && m.matched === users[x].id || m.matcher === users[x].id && m.matched ===  {{auth()->user()->id}}) {
                                        user_is_matched = true
                                    }
                                });
                            }
                            console.log(users[x].name);
                            if (pictures[i].picture_path.includes('photo1') && pictures[i].user_id === users[x].id && !user_is_liked && !user_is_matched) {
                                console.log('yep');
                                //$(`<div class="is_match m-auto"><h5 class="is_match m-auto">IT'S A MATCh</h5><img src="http://localhost:3300/storage/${pictures[i].picture_path}" style="width: 100%" alt=""></div>`).appendTo($('#partners'));
                                $(`<div class="cardd m-auto" id="cardd${users[x].id}" data-id="${users[x].id}"><img onclick="nextPhoto(${users[x].id})"  src="http://localhost:3300/storage/${pictures[i].picture_path}" style="" alt=""><div class="cardd_footer"><h3><strong>${users[x].name}</strong> ${users[x].age}</h3> <h5 style="color:rgba(235,232,231,255)">${users[x].location}</h5><h5  style="color:rgba(235,232,231,255)">${users[x].bio}</h5></div><div class="icons m-auto d-flex justify-content-between"><a onclick="denyUser(${users[x].id})" href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a><a onclick="likeUser(${users[x].id})"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a></div></div>`).appendTo($('#partners'));
                                $('#cardd'+users[x].id).show('slow');
                                added = true;
                                break;
                            }
                        };
                        if(added) break;
                    };
                if(!added){
                    $(`<h5 class="m-auto" style="text-align: center">We could not find people that reunite such requisites</h5>`).appendTo($('#partners'));;
                }
            },
            dataType: "json"
        });


        function likeUser(id) {
            $.ajax({
                //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
                url: 'http://localhost:3300/user/likeUser/'+id,
                success: function (data) {
                    $('#cardd'+id).hide('fast');
                    var added = false;
                    var its_a_match = data['is_match'];
                    if(its_a_match){
                        $('#partners').children().hide('fast').remove();
                        $('#partners').hide('fast');
                        $(`<h1 style="text-align: center;font-family: verdana; color: rgba(0,255,203,255);
    font-size: 12em;
    font-weight: 700;
       text-shadow: -10px 10px 0px #00e6e6,
                 -20px 20px 0px #01cccc,
                 -30px 30px 0px #00bdbd; letter-spacing: 1.5px">IT'S A MATCH</h1>`).appendTo($('#its_a_match'))
                        var pic1_added = false;
                        var pic2_added = false;
                        var pic1_path = null;
                        var pic2_path = null;
                        for(let i = 0; i < pictures.length;i++) {
                            if(pictures[i].picture_path.includes('photo1') && pictures[i].user_id === id && !pic1_added){
                                pic1_added = true;
                                pic1_path = pictures[i].picture_path;
                            }
                            else if(pictures[i].picture_path.includes('photo1') && pictures[i].user_id === {{auth()->user()->id}} && !pic2_added){
                                pic2_added = true;
                                pic2_path = pictures[i].picture_path;
                            }
                        }
                        $(`<div class="d-flex justify-content-sm-between"><div class="match_card" id="match_card${id}"><img onclick="nextPhoto(${users[x].id}) src="http://localhost:3300/storage/${pic2_path}" style="" alt=""></div><div class="match_card2" id="match_card${id}"><img src="http://localhost:3300/storage/${pic1_path}" style="" alt=""></div></div>`).appendTo($('#its_a_match'))
                        $("#its_a_match").children().slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
                        $("#its_a_match").slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
                        $(function(){
                            setTimeout(function() {
                                $("#its_a_match").children().hide('slow');
                                $("#its_a_match").children().remove();
                                $('#partners').children().show('fast');
                                $('#partners').show('fast');

                            }, 5000);
                        });
                    }
                    likedUsers.push(id);
                        for (let x = 0; x < users.length;x++){
                            var user_is_liked = false;
                            var user_is_matched = false;
                            let userWasLiked = false;
                            for(let y = 0; y < likedUsers.length;y++){
                                console.log(likedUsers[y].name);
                                if(likedUsers[y] === users[x].id ) {
                                    console.log(likedUsers[y]);
                                    userWasLiked = true;
                                    break;
                                }
                            }
                            for(let i = 0; i < pictures.length;i++) {
                                if(likes.length > 0){
                                    likes.forEach(function (l){
                                        if(l.like_giver === {{auth()->user()->id}} && l.like_receiver === users[x].id){
                                            user_is_liked = true;
                                        }
                                    });
                                }
                                if (matches.length > 0) {
                                    matches.forEach(function (m) {
                                        if(m.matcher === {{auth()->user()->id}} && m.matched === users[x].id || m.matcher === users[x].id && m.matched ===  {{auth()->user()->id}}) {
                                            user_is_matched = true
                                        }
                                    });
                                }
                                console.log(user_is_liked);
                                if (pictures[i].picture_path.includes('photo1') && pictures[i].user_id === users[x].id && !userWasLiked && !user_is_liked && !user_is_matched) {
                                    console.log("here");
                                    $(`<div class="cardd m-auto" id="cardd${users[x].id}" data-id="${users[x].id}"><div class="is_match" style="display: none"></div><img src="http://localhost:3300/storage/${pictures[i].picture_path}" style="" alt=""><div class="cardd_footer"><h3><strong>${users[x].name}</strong> ${users[x].age}</h3> <h5  style="color:rgba(235,232,231,255)">${users[x].location}</h5><h5 style="color:rgba(235,232,231,255)">${users[x].bio}</h5></div><div class="icons m-auto d-flex justify-content-between"><a onclick="denyUser(${users[x].id})" href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a><a onclick="likeUser(${users[x].id})"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a></div></div>`).appendTo($('#partners'));
                                    $('#cardd'+users[x].id).show('slow');
                                    added = true;
                                    break;
                                }
                            };
                            if(added) break;
                        };
                        if(!added){
                            $(`<h5 class="m-auto" style="text-align: center">Seems like you've reached the end of the list!</h5>`).appendTo($('#partners'));
                        }
                },
                error: function (err){
                },
            });
        }

        function denyUser(id) {
            $('#cardd'+id).hide('fast');
            likedUsers.push(id);
            var added = false;
            for (let x = 0; x < users.length;x++){
                let userWasLiked = false;
                var user_is_liked = false;
                var user_is_matched = false;
                for(let y = 0; y < likedUsers.length;y++){
                    console.log(likedUsers[y].name);
                    if(likedUsers[y] === users[x].id ) {
                        console.log(likedUsers[y]);
                        userWasLiked = true;
                        break;
                    }
                }
                for(let i = 0; i < pictures.length;i++) {
                    if(likes.length > 0){
                        likes.forEach(function (l){
                            if(l.like_giver === {{auth()->user()->id}} && l.like_receiver === users[x].id){
                                user_is_liked = true;
                            }
                        });
                    }
                    if (matches.length > 0) {
                        matches.forEach(function (m) {
                            if(m.matcher === {{auth()->user()->id}} && m.matched === users[x].id || m.matcher === users[x].id && m.matched ===  {{auth()->user()->id}}) {
                                user_is_matched = true
                            }
                        });
                    }
                    console.log(user_is_liked);
                    if (pictures[i].picture_path.includes('photo1') && pictures[i].user_id === users[x].id && !userWasLiked &&!user_is_liked && !user_is_matched) {
                        console.log("here");
                        $(`<div class="cardd m-auto" id="cardd${users[x].id}" data-id="${users[x].id}"><img onclick="nextPhoto(${users[x].id})" src="http://localhost:3300/storage/${pictures[i].picture_path}" style="" alt=""><div class="cardd_footer"><h3><strong>${users[x].name}</strong> ${users[x].age}</h3> <h5 style="color:rgba(235,232,231,255)">${users[x].location}</h5><h5 style="color:rgba(235,232,231,255)">${users[x].bio}</h5></div><div class="icons m-auto d-flex justify-content-between"><a onclick="denyUser(${users[x].id})" href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a><a onclick="likeUser(${users[x].id})"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a></div></div>`).appendTo($('#partners'));
                        $('#cardd'+users[x].id).show('slow');
                        added = true;
                        break;
                    }
                };
                if(added) break;
            };
            if(!added){
                $(`<h5 class="m-auto" style="text-align: center">Seems like you've reached the end of the list!</h5>`).appendTo($('#partners'));;
            }
        }
        $(document).ready(function () {
        });

    </script>
@endsection
