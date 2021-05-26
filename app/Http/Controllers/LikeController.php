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
        if(count($likes)> 0) {

            foreach ($users as $u) {
                foreach ($likes as $l) {
                    if ($l->like_giver != $u->id) unset($u);
                }
            }
        }

        return compact('users', 'pictures', 'likes');

    }
}
