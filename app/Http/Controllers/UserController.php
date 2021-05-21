<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Picture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('users.updateprofile');
    }

    function updateUserData(Request $request){

        $user = User::findOrFail(auth()->user()->id);
        if(User::where('email', '=', $request->input('email'))->where('id', '!=', auth()->user()->id)->exists())
        {
            return redirect()->route('modifyProfile')->with('message', 'The desired email is already taken!');
        }
        else{
            if($request->file('photo1') != null){
                //add photo

                $picture = new Picture();
                if($this.$this->isImage($request->file('photo1'))){

                    $pictures = Picture::where('user_id', '=', auth()->user()->id);
                    if(count($pictures) == 3){
                        foreach ($pictures as $p){
                            if($p->picture_path == 'public/imgs/pfp/'. auth()->user()->name."photo1"){
                                    Storage::delete($p->picture_path);
                                    break;
                            }
                        }
                        $request->input('photo1')->move('public/imgs/pfp', 'photo1');
                        $picture->user_id = auth()->user()->id;
                        $picture->picture_path = 'public/imgs/pfp/photo1';
                        $picture->save();

                    }
                    else{
                        $request->input('photo1')->move('public/imgs/pfp', 'photo1');
                        $picture->user_id = auth()->user()->id;
                        $picture->picture_path = 'public/imgs/pfp/photo1';
                        $picture->save();
                    }



                }
            }

            if($request->file('photo2') != null){
                //add photo
                if($this.$this->isImage($request->file('photo2'))){

                }
            }

            if($request->file('photo3') != null){
                //add photo
                if($this.$this->isImage($request->file('photo3'))){

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
            return redirect()->route('updateProfile')->with('message', 'Data updated successfully!');
        }
    }
}
