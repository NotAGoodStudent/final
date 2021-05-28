<?php

namespace App\Http\Controllers;

use App\Match;
use App\Picture;
use App\User;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    function returnMatchesView(){
        $matches = Match::where('matcher', '=', auth()->user()->id)->orWhere('matched', '=', auth()->user()->id)->get();
        return view('users.matches', compact('matches'));
    }

    function getMatchesData(){
        $pictures = Picture::all();
        $matches = Match::where('matcher', '=', auth()->user()->id)->orWhere('matched', '=', auth()->user()->id)->get();
        $users = User::all();
        $users_clear = [];
        if(count($matches)> 0) {
            foreach ($matches as $m) {
                foreach ($users as $u){
                    $exists = false;
                    foreach ($users_clear as $c){
                        if($c->id == $u->id){
                            $exists = true;
                            break;
                        }
                    }
                    if(auth()->user()->id != $u->id && $u->id == $m->matcher && !$exists || auth()->user()->id != $u->id && $u->id == $m->matched && !$exists){
                        array_push($users_clear, $u);
                        break;
                    }
                }

            }
        }
        return compact('users_clear', 'pictures', 'matches');

    }
}
