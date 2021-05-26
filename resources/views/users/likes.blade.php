@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/likesStyle.css') }}" rel="stylesheet">
    @if(count($likes) > 0)
        <div class="partners m-auto mt-5 d-flex justify-content-around" id="partners">
        </div>
    @else
        <div class="center">
            <h5 style="text-align: center">Well...</h5>
            <p style="text-align: center">Seems like you've got no likes yet</p>
            <img style="text-align: center" class="mt-5" src="{{Storage::url('imgs/front/brheart.png')}}" alt="">
        </div>
    @endif

    <script>
        $.ajax({
            //url: 'http://ec2-3-236-81-152.compute-1.amazonaws.com:3300/topics/getTopics',
            url: 'http://localhost:3300/likes/getLikesData',
            success: function (data) {
                users = data['users'];
                pictures = data['pictures'];
                for(let x = 0; x < users.length;x++){
                    for(let i = 0; i < pictures.length;i++){
                        if(pictures[i].picture_path.includes('photo1') && pictures[i].user_id === users[x].id){
                            console.log("XD");
                            $(`<div class='cardd'><img src="http://localhost:3300/storage/${pictures[i].picture_path}"><div class="cardd_footer"><h3><strong>${users[x].name} ${users[x].age}</strong></div></div>`).appendTo($('#partners'));
                        }
                    }
                }




            },
            error: function (d){
                console.log(d);
            },
            dataType: "json"
        });
    </script>
@endsection
