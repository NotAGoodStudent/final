@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/likesStyle.css') }}" rel="stylesheet">
    @if(count($likes) > 0)
        <div class="partners m-auto mt-5 d-flex justify-content-sm-start" id="partners">
        </div>
        <div class="pickedCard" id="pickedCard">

        </div>
        <div class="its_a_match m-auto mt-5" id="its_a_match">

        </div>
    @else
        <div class="center">
            <h1 style="text-align: center">Well...</h1>
            <h5 style="text-align: center">Seems like you've got no likes yet</h5>
            <img style="text-align: center" class="mt-5" src="{{Storage::url('imgs/front/brheart.png')}}" alt="">
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
                    }
                }

            }
            else if(img_path.includes('photo2')){

                for(let x = 0; x< pictures.length;x++){
                    if(pictures[x].picture_path.includes('photo3') && pictures[x].user_id === id){
                        $('#cardd'+id).find('img').attr('src', 'http://localhost:3300/storage/'+pictures[x].picture_path);
                    }
                }
            }
            else if(img_path.includes('photo3')){

                for(let x = 0; x< pictures.length;x++){
                    if(pictures[x].picture_path.includes('photo1') && pictures[x].user_id === id){
                        $('#cardd'+id).find('img').attr('src', 'http://localhost:3300/storage/'+pictures[x].picture_path);
                    }
                }
            }
        }

        function likeUser(id) {
            $.ajax({
                //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
                url: 'http://localhost:3300/user/likeUser/'+id,
                success: function (data) {
                    var its_a_match = data['is_match'];
                    if(its_a_match) {
                        $('#partners').children().hide('fast');
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
                        for (let i = 0; i < pictures.length; i++) {
                            if (pictures[i].picture_path.includes('photo1') && pictures[i].user_id === id && !pic1_added) {
                                pic1_added = true;
                                pic1_path = pictures[i].picture_path;
                            } else if (pictures[i].picture_path.includes('photo1') && pictures[i].user_id === {{auth()->user()->id}} && !pic2_added) {
                                pic2_added = true;
                                pic2_path = pictures[i].picture_path;
                            }
                        }
                        $(`<div class="d-flex justify-content-sm-between"><div class="match_card" id="match_card${id}"><img src="http://localhost:3300/storage/${pic2_path}" style="" alt=""></div><div class="match_card2" id="match_card${id}"><img src="http://localhost:3300/storage/${pic1_path}" style="" alt=""></div></div>`).appendTo($('#its_a_match'))
                        $('#pickedCard').children().remove();
                        $('#pickedCard').hide();
                        $("#its_a_match").children().slideUp('slow').delay('slow').fadeIn('slow');
                        $("#its_a_match").slideUp('slow').delay('slow').fadeIn('slow');
                        $(function () {
                            setTimeout(function () {
                                $("#its_a_match").children().hide('slow');
                                $("#its_a_match").children().remove();
                                $('#partners').find('#cardd'+id).remove();
                                $('#partners').children().slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
                                $('#partners').slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );

                            }, 5000);
                        });

                    }
                },
                error: function (err){
                    console.log(err);
                },
            });
        }

        function denyUser(id) {
            $.ajax({
                //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
                url: 'http://localhost:3300/user/removeLike/'+id,
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

        function escape(id){
            $('#pickedCard').find('#cardd'+id).hide('slow');
            $('#pickedCard').find('#cardd'+id).appendTo($('#partners'));
            $('#pickedCard').children().remove();
            $('#pickedCard').hide('fast');
            $('#partners').find('#cardd'+id).removeClass('cardd_sel m-auto');
            $('#partners').find('#cardd'+id).find('.escape').remove();
            $('#partners').find('#cardd'+id).find('.cardd_sel_footer').remove();
            $('#partners').find('#cardd'+id).find('.icons').remove();
            $('#partners').find('#cardd'+id).addClass('cardd');
            $('#partners').children().slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
            $('#partners').slideUp( 'slow' ).delay( 'slow' ).fadeIn( 'slow' );
        }
        function showPickedCard(id){
            $(`<div class="icons m-auto d-flex justify-content-between"><a onclick="denyUser(${id})" href="#"><i style="color: red;padding: 15px; padding-left: 25px;padding-right: 25px;" class="fas fa-times"></i></a><a onclick="likeUser(${id})"><i style="color: #2ecc71;padding: 17px;" class="fas fa-heart"></i></a></div>`).appendTo($('#cardd'+id))
            $('#cardd'+id).removeClass('cardd');
            $('#cardd'+id).find('.cardd_footer').remove();
            for(let x = 0; x < users.length;x++){
                if(users[x].id == id){
                    $(`<div class="escape"><a onclick="escape(${id})" id="cross"><i class="fas fa-times"></i></a></div><div class="cardd_sel_footer"><h3 style="color: white"><strong style="color: white">${users[x].name}</strong> ${users[x].age}</h3> <h5 style="color:rgba(235,232,231,255)">${users[x].location}</h5><h5  style="color:rgba(235,232,231,255)">${users[x].bio}</h5></div>`).appendTo($('#cardd'+id));
                }
            }
            $('#cardd'+id).addClass('cardd_sel m-auto')
            $('#cardd'+id).appendTo($('#pickedCard'));
            $('#partners').children().hide('slow');
            $('#partners').hide('slow');
            $('#pickedCard').find('#cardd'+id).unbind('click')
            $('#pickedCard').find('#cardd'+id).bind('click', nextPhoto(id))
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
                            $(`<div class='cardd' id="cardd${users[x].id}"><img onclick="showPickedCard(${users[x].id})" src="http://localhost:3300/storage/${pictures[i].picture_path}"></div>`).appendTo($('#partners'));
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
