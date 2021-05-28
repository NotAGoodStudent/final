<?php

namespace App\Http\Controllers;

use App\Like;
use App\Match;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Picture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    public function isImage($img)
    {

        $rules = array(
            'image' => 'mimes:jpeg,jpg,png|required|max:10000' // max 10000kb
        );


        $fileArr = array('image'=>$img);
        $validator = Validator::make($fileArr, $rules);

        // Check to see if validation fails or passes
        if ($validator->fails())
        {
            return false;
        } else
        {
            return true;
        };
    }
    function returnUpdateProfile(){
        $pictures = Picture::where('user_id', '=', auth()->user()->id)->get();
        return view('users.updateprofile', compact('pictures'));
    }


    function updateUserData(Request $request){

        $user = User::findOrFail(auth()->user()->id);
        if(User::where('email', '=', $request->input('email'))->where('id', '!=', auth()->user()->id)->exists())
        {
            $request->session()->flash('alert-danger', 'The desired email is already in use!');
            return redirect()->route('updateProfile');
        }
        else{
            echo 'here';
            echo is_null($request->file('photo1') );
            if($request->file('photo1') != null){
                //add photo

                echo 'is not null';
                $picture = new Picture();
                $extension = $request->file('photo1')->extension();
                if($this->isImage($request->file('photo1')))
                {

                    echo 'is image  ';
                    $pictures = Picture::where('user_id', '=', auth()->user()->id)->get();
                    if(count($pictures) >= 1){
                        foreach ($pictures as $p){
                            if($p->picture_path == '/imgs/pfp/'. auth()->user()->id."/photo1.".'png' || $p->picture_path == '/imgs/pfp/'. auth()->user()->id."/photo1.".'jpg' || $p->picture_path == '/imgs/pfp/'. auth()->user()->id."/photo1.".'jpeg'){
                                Picture::where('picture_path', '=', '/imgs/pfp/'.auth()->user()->id."/photo1.".$extension)->delete();
                                Storage::delete($p->picture_path);
                                break;
                            }
                        }
                        $request->file('photo1')->storeAs('public/imgs/pfp/'. auth()->user()->id, 'photo1'.'.'.$extension);
                        $picture->user_id = auth()->user()->id;
                        $picture->picture_path = '/imgs/pfp/'.auth()->user()->id.'/photo1.'.$extension;
                        $picture->save();
                    }
                    else{
                        echo 'here';
                        $request->file('photo1')->storeAs('public/imgs/pfp/'. auth()->user()->id, 'photo1'.'.'.$extension);
                        $picture->user_id = auth()->user()->id;
                        $picture->picture_path = '/imgs/pfp/'.auth()->user()->id.'/photo1.'.$extension;
                        $picture->save();
                    }



                }
            }

            if($request->file('photo2') != null){
                //add photo

                echo 'is not null';
                $picture = new Picture();
                $extension = $request->file('photo2')->extension();
                if($this->isImage($request->file('photo2')))
                {

                    echo 'is image  ';
                    $pictures = Picture::where('user_id', '=', auth()->user()->id)->get();
                    if(count($pictures) >= 1){
                        foreach ($pictures as $p){
                            if($p->picture_path == '/imgs/pfp/'. auth()->user()->id."/photo2.".'png' || $p->picture_path == '/imgs/pfp/'. auth()->user()->id."/photo2.".'jpg' || $p->picture_path == '/imgs/pfp/'. auth()->user()->id."/photo2.".'jpeg'){
                                Picture::where('picture_path', '=', '/imgs/pfp/'.auth()->user()->id.'/photo2.'.$extension)->delete();
                                Storage::delete($p->picture_path);
                                break;
                            }
                        }
                        $request->file('photo2')->storeAs('public/imgs/pfp/'. auth()->user()->id, 'photo2'.'.'.$extension);
                        $picture->user_id = auth()->user()->id;
                        $picture->picture_path = '/imgs/pfp/'.auth()->user()->id.'/photo2.'.$extension;
                        $picture->save();
                    }
                    else{
                        echo 'here';
                        $request->file('photo2')->storeAs('public/imgs/pfp/'. auth()->user()->id, 'photo2'.'.'.$extension);
                        $picture->user_id = auth()->user()->id;
                        $picture->picture_path = '/imgs/pfp/'.auth()->user()->id.'/photo2.'.$extension;
                        $picture->save();
                    }



                }
            }

            if($request->file('photo3') != null){
                //add photo

                echo 'is not null';
                $picture = new Picture();
                $extension = $request->file('photo3')->extension();
                if($this->isImage($request->file('photo3')))
                {

                    echo 'is image  ';
                    $pictures = Picture::where('user_id', '=', auth()->user()->id)->get();
                    if(count($pictures) >= 1){
                        foreach ($pictures as $p){
                            if($p->picture_path == '/imgs/pfp/'. auth()->user()->id."/photo3.".'png' || $p->picture_path == '/imgs/pfp/'. auth()->user()->id."/photo3.".'jpg' || $p->picture_path == '/imgs/pfp/'. auth()->user()->id."/photo3.".'jpeg'){
                                Picture::where('picture_path', '=', '/imgs/pfp/'. auth()->user()->id."/photo3.".$extension)->delete();
                                Storage::delete($p->picture_path);
                                break;
                            }
                        }
                        $request->file('photo3')->storeAs('public/imgs/pfp/'. auth()->user()->id, 'photo3'.'.'.$extension);
                        $picture->user_id = auth()->user()->id;
                        $picture->picture_path = '/imgs/pfp/'.auth()->user()->id.'/photo3.'.$extension;
                        $picture->save();
                    }
                    else{
                        echo 'here';
                        $extension = $request->file('photo3')->extension();
                        $request->file('photo3')->storeAs('public/imgs/pfp/'. auth()->user()->id, 'photo3'.'.'.$extension);
                        $picture->user_id = auth()->user()->id;
                        $picture->picture_path = '/imgs/pfp/'.auth()->user()->id.'/photo3.'.$extension;
                        $picture->save();
                    }



                }
            }

            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
            $user->email = $request->input('email');
            if($request->input('bio') != null) {
                $user->bio = $request->input('bio');
            }
            $user->interested_in = $request->input('interested_in');
            $user->age = $request->input('age');
            $user->save();
            $request->session()->flash('alert-success', 'Data was successfully updated!');
            return redirect()->route('updateProfile');
        }
    }

    function likeUser($id)
    {
        $likes_for_user = Like::where('like_receiver', '=', auth()->user()->id)->get();
        if(count($likes_for_user) > 0){
            foreach ($likes_for_user as $l){
                if($l->like_giver == $id){
                    $match = new Match();
                    $match->matcher = auth()->user()->id;
                    $match->matched = $id;
                    $match->save();
                    Like::where('like_receiver', '=', auth()->user()->id)->where('like_giver', '=', $id)->delete();
                    return "match happened";
                }
            }

        }

        $like = new Like();
        $like->like_giver = auth()->user()->id;
        $like->like_receiver = $id;
        $like->save();
    }

    function removelikeUser($id){
        Like::where('like_giver', '=', $id)->where('like_receiver', '=', auth()->user()->id)->delete();
    }

    function getHomeData(){
        if(auth()->user()->interested_in != null)
        {
            $pictures = Picture::all();
            $likes = Like::all();
            $matches = Match::all();
            $users = null;

            if (auth()->user()->interested_in == 'Both') {
                $users = User::where('id', '!=', auth()->user()->id)->where('gender', '=', 'Male')->orWhere('gender', '=', 'Female')->where('interested_in', '=', 'Both')->orWhere('interested_in', '=', auth()->user()->gender)->where('location', '=', auth()->user()->location)->get();
            }
            elseif(auth()->user()->interested_in == 'Male') {
                $users = User::where('interested_in', '=', auth()->user()->gender)->where('gender', '=', auth()->user()->interested_in)->where('id', '!=', auth()->user()->id)->where('location', '=', auth()->user()->location)->get();
            }
            elseif(auth()->user()->interested_in == 'Female'){
                $users = User::where('interested_in', '=', auth()->user()->gender)->orWhere('interested_in', '=', 'Both')->where('gender', '=', auth()->user()->interested_in)->where('id', '!=', auth()->user()->id)->where('location', '=', auth()->user()->location)->get();
            }
            return compact('users', 'pictures', 'likes', 'matches');
        }
    }

}
