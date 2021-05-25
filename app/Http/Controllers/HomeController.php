<?php

namespace App\Http\Controllers;

use App\Like;
use App\Match;
use App\Picture;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->interested_in != null)
        {
            $pictures = Picture::all();
            $likes = Like::all();
            $matches =Match::all();

            if (auth()->user()->interested_in == 'Both') {
                $users = User::where('id', '!=', auth()->user()->id)->where('gender', '=', 'Male')->orWhere('gender', '=', 'Female')->where('interested_in', '=', 'Both')->orWhere('interested_in', '=', auth()->user()->gender)->where('location', '=', auth()->user()->location)->get();
            }
            elseif(auth()->user()->interested_in == 'Male') {
                $users = User::where('interested_in', '=', auth()->user()->interested_in)->where('gender', '=', auth()->user()->interested_in)->where('id', '!=', auth()->user()->id)->where('location', '=', auth()->user()->location)->get();
            }
            else{
                $users = User::where('interested_in', '=', auth()->user()->interested_in)->where('gender', '=', auth()->user()->interested_in)->where('id', '!=', auth()->user()->id)->where('location', '=', auth()->user()->location)->get();
            }
            return view('users.home', compact('users', 'pictures', 'likes', 'matches'));
        }
        return view('users.home');
    }
}
