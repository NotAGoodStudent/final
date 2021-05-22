<?php

namespace App\Http\Controllers;

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

            if (auth()->user()->interested_in == 'Both') {
                $users = User::where('interested_in', '=', auth()->user()->gender || 'Both')->where('id', '!=', auth()->user()->id)->get();
            }
            else {
                $users = User::where('interested_in', '=', auth()->user()->gender)->where('gender', '=', auth()->user()->interested_in)->where('id', '!=', auth()->user()->id)->get();
            }
            return view('users.home', compact('users'));
        }
        return view('users.home');
    }
}
