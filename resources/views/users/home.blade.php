@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/homeStyle.css') }}" rel="stylesheet">
@if(auth()->user()->interested_in == null)
    <h5 style="text-align: center">Hi {{auth()->user()->name}}</h5>
    <p style="text-align: center">Please let us know more about <span><a href="{{route('updateProfile')}}" style="">you</a></span> before you get started</p>
@else

    <div class="partners m-auto mt-5 justify-center" id="partners">
    </div>
@endif
    <script>


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
                users = data['users'];
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
                                $(`<div class="cardd m-auto" id="cardd${users[x].id}" data-id="${users[x].id}"><img src="http://localhost:3300/storage/${pictures[i].picture_path}" style="" alt=""><div class="cardd_footer"><h3><strong>${users[x].name}</strong> ${users[x].age}</h3> <h5 style="color:rgba(235,232,231,255)">${users[x].location}</h5><h5  style="color:rgba(235,232,231,255)">${users[x].bio}</h5></div><div class="icons m-auto d-flex justify-content-between"><a onclick="denyUser(${users[x].id})" href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a><a onclick="likeUser(${users[x].id})"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a></div></div>`).appendTo($('#partners'));
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
                    $('#cardd'+id).hide('slow');
                    let added = false;
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
            $('#cardd'+id).hide('slow');
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
                        $(`<div class="cardd m-auto" id="cardd${users[x].id}" data-id="${users[x].id}"><img src="http://localhost:3300/storage/${pictures[i].picture_path}" style="" alt=""><div class="cardd_footer"><h3><strong>${users[x].name}</strong> ${users[x].age}</h3> <h5 style="color:rgba(235,232,231,255)">${users[x].location}</h5><h5 style="color:rgba(235,232,231,255)">${users[x].bio}</h5></div><div class="icons m-auto d-flex justify-content-between"><a onclick="denyUser(${users[x].id})" href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a><a onclick="likeUser(${users[x].id})"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a></div></div>`).appendTo($('#partners'));
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
