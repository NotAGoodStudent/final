<?php

namespace App\Http\Controllers;

use App\Like;
use App\Picture;
use App\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    function returnLikesView(){
        $likes = Like::where('like_receiver', '=', auth()->user()->id)->get();
        return view('users.likes', compact('likes'));

    }

    function getLikesData(){
        $pictures = Picture::all();
        $likes = Like::where('like_receiver', '=', auth()->user()->id)->get();
        $users = User::all();
        $users_clear = [];
        if(count($likes)> 0) {

            foreach ($likes as $l) {
                foreach ($users as $u) {
                    if ($l->like_giver == $u->id){
                        array_push($users_clear, $u);
                    }
                }
            }
        }
        return compact('users_clear', 'pictures', 'likes');

    }
}
