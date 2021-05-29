<?php

namespace App\Http\Controllers;

use App\Like;
use App\Picture;
use App\User;
use App\Match;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    function likeUser($id)
    {

        $likes_for_user = Like::where('like_receiver', '=', auth()->user()->id)->get();
        if(count($likes_for_user) > 0){
            foreach ($likes_for_user as $l){
                if($l->like_giver == $id){
                    $is_match=true;
                    $match = new Match();
                    $match->matcher = auth()->user()->id;
                    $match->matched = $id;
                    $match->save();
                    Like::where('like_receiver', '=', auth()->user()->id)->where('like_giver', '=', $id)->delete();
                    return compact('is_match');
                }
            }

        }
        $like = new Like();
        $like->like_giver = auth()->user()->id;
        $like->like_receiver = $id;
        $like->save();
    }

    function removeLike($id){
        Like::where('like_giver', '=', $id)->where('like_receiver', '=', auth()->user()->id)->delete();
    }

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
