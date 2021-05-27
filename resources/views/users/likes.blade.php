@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/likesStyle.css') }}" rel="stylesheet">
    @if(count($likes) > 0)
        <div class="partners m-auto mt-5 d-flex justify-content-between" id="partners">
        </div>
        <div class="pickedCard" id="pickedCard">

        </div>
    @else
        <div class="center">
            <h1 style="text-align: center">Well...</h1>
            <h5 style="text-align: center">Seems like you've got no likes yet</h5>
            <img style="text-align: center" class="mt-5" src="{{Storage::url('imgs/front/brheart.png')}}" alt="">
        </div>
    @endif

    <script>

        function likeUser(id) {
            $.ajax({
                //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
                url: 'http://localhost:3300/user/likeUser/'+id,
                success: function (data) {
                    $('#cardd'+id).hide('slow');
                },
                error: function (err){
                },
            });
        }

        function denyUser(id) {
            $.ajax({
                //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
                url: 'http://localhost:3300/user/removelikeUser/'+id,
                success: function (data) {
                    $('#pickedCard').children().remove();
                    $('#pickedCard').hide()
                    $('#partners').find('#cardd'+id).remove();
                    $('#partners').children().slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
                    $('#partners').slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
                },
                error: function (err){
                },
            });
        }
        function showPickedCard(id){
            $(`<div class="icons m-auto d-flex justify-content-between"><a onclick="denyUser(${id})" href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a><a onclick="likeUser(${id})"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a></div>`).appendTo($('#cardd'+id))
            $('#cardd'+id).removeClass('cardd');
            $('#cardd'+id).find('.cardd_footer').remove();
            for(let x = 0; x < users.length;x++){
                if(users[x].id == id){
                    $(`<div class="cardd_sel_footer"><h3><strong>${users[x].name}</strong> ${users[x].age}</h3> <h5 style="color:rgba(235,232,231,255)">${users[x].location}</h5><h5  style="color:rgba(235,232,231,255)">${users[x].bio}</h5></div>`).appendTo($('#cardd'+id));
                }
            }
            $('#cardd'+id).addClass('cardd_sel m-auto')
            $('#cardd'+id).appendTo($('#pickedCard'));
            $('#partners').children().hide('slow');
            $('#partners').hide('slow');
            $('#pickedCard').show('slow');
        }
        $.ajax({
            //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
            url: 'http://localhost:3300/likes/getLikesData',
            success: function (data) {
                users = data['users_clear'];
                pictures = data['pictures'];
                $('#partners').show();
                for(let x = 0; x < users.length;x++){
                    for(let i = 0; i < pictures.length;i++){
                        if(pictures[i].picture_path.includes('photo1') && pictures[i].user_id === users[x].id){
                            console.log("XD");
                            $(`<div class='cardd' id="cardd${users[x].id}"><img onclick="showPickedCard(${users[x].id})" src="http://localhost:3300/storage/${pictures[i].picture_path}"><div class="cardd_footer"><h3><strong>${users[x].name} ${users[x].age}</strong></div></div>`).appendTo($('#partners'));
                        }
                    }
                }

                $('.cardd').each(function (x, card){
                        $(this).slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
                });
            },
            error: function (d){
                console.log(d);
            },
            dataType: "json"
        });
    </script>
@endsection
