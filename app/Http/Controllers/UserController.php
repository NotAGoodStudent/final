<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function returnUpdateProfile(){
        return view('users.updateprofile');
    }

    function updateUserData(Request $request){

        $user = User::findOrFail(auth()->user()->id);
        if(User::where('email', '=', $request->input('email'))->where('id', '!=', auth()->user()->id)->exists())
        {
            return redirect()->route('modifyProfile')->with('message', 'The desired email is already taken!');
        }
        else{

        }

    }
}
