@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/homeStyle.css') }}" rel="stylesheet">
@if(auth()->user()->interested_in == null)
    <h5 style="text-align: center">Hi {{auth()->user()->name}}</h5>
    <p style="text-align: center">Please let us know more about <span><a href="{{route('updateProfile')}}" style="">you</a></span> before you get started</p>
@else
    <div class="partners m-auto mt-5" id="partners">
    </div>
@endif
    <script>

        function checkIfLiked(){
            users.forEach(function (u){

                if(likes.length > 0){
                    likes.forEach(function (l){
                        if(l.like_giver === {{auth()->user()->id}}) return true;
                    });
                }
            });
        }

        function checkIfMatched(){
            users.forEach(function (u) {
                if (matches.length > 0) {
                    matches.forEach(function (m) {
                        if(m.matcher === {{auth()->user()->id}} || m.matched === {{auth()->user()->id}}) return true
                    });
                }
            });

        }
        var saveUserID = 0;
        $.ajax({
            //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
            url: 'http://localhost:3300/user/getHomeData',
            success: function (data) {
                console.log(data);
                var users = data['users'];
                var pictures = data['pictures'];
                var likes = data['likes'];
                var matches = data['matches'];
                var is_matched = false;
                var is_liked = false;

                if(checkIfLiked && checkIfMatched) {

                    let added = false;
                    for (let x = 0; x < users.length;x++){
                        for(let i = 0; i < pictures.length;i++) {
                            if (pictures[i].picture_path.includes('photo1') && pictures[i].user_id === users[x].id) {
                                $(`<div class="cardd m-auto" id="cardd${users[x].id}" data-id="${users[x].id}"><img src="http://localhost:3300/storage/${pictures[i].picture_path}" style="" alt=""><div class="cardd_footer"><h3><strong>${users[x].name}</strong> ${users[x].age}</h3> <h5>${users[x].location}</h5><h5>${users[x].bio}</h5></div><div class="icons m-auto d-flex justify-content-between"><a onclick="denyUser()" href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a><a onclick="likeUser(${users[x].id})"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a></div></div>`).appendTo($('#partners'));
                                $('#cardd'+users[x].id).show('slow');
                                saveUserID = users[x].id;
                                added = true;
                                break;
                            }
                        };
                        if(added) break;
                    };
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
                    if(checkIfLiked && checkIfMatched) {

                        let added = false;
                        for (let x = 0; x < users.length;x++){
                            for(let i = 0; i < pictures.length;i++) {
                                console.log("gere");
                                if (pictures[i].picture_path.includes('photo1') && pictures[i].user_id === {{auth()->user()->id}} && saveUserID !== users[x].id) {
                                    console.log("here");
                                    $(`<div class="cardd m-auto" id="cardd${users[x].id}" data-id="${users[x].id}"><img src="http://localhost:3300/storage/${pictures[i].picture_path}" style="" alt=""><div class="cardd_footer"><h3><strong>${users[x].name}</strong> ${users[x].age}</h3> <h5>${users[x].location}</h5><h5>${users[x].bio}</h5></div><div class="icons m-auto d-flex justify-content-between"><a onclick="denyUser()" href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a><a onclick="likeUser(${users[x].id})"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a></div></div>`).appendTo($('#partners'));
                                    $('#cardd'+users[x].id).show('slow');
                                    saveUserID = users[x].id;
                                    added = true;
                                    break;
                                }
                            };
                            if(added) break;
                        };
                    }
                },
                error: function (err){
                    console.log(err);
                },
            });
        }

        function passUser(id) {
            $.ajax({
                //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
                url: 'http://localhost:3300/user/passUser/'+id,
                success: function (data) {

                    $('#cardd'+id).hide('slow');
                    match = data;
                    console.log("yay");
                },
                dataType: "json"
            });
        }
        $(document).ready(function () {
        });

    </script>
@endsection
