<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\http\Response;

class UserController extends Controller
{

    public function Logout()

    {

        Auth::logout();

       return redirect() ->route('home')->with(['message'=> 'You have been successfully Logged out']);
    }


    public function Signup(Request  $request)

    {
        $this->validate($request, [
            'email' =>  'email|unique:users',
            'name' =>   'required|max:120',
            'password' => 'required|max:20'
        ]);

    	$email = $request ['email'];
    	$name = $request['name'];    	
    	$password = bcrypt($request['password']);

    	$user = new User();
    	$user->email = $email;
    	$user->password = $password;
    	$user->name = $name;
    	$user-> save();

    	return redirect()->route('dashboard');

    }

    public function postSignIn(Request $request)
    {
    	if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
    		return redirect()-> route('dashboard');
    	}
    	return redirect() -> back();

    }

    public function getDashboard()
    {
    	return view('dashboard');
    }


    public function getAccount(){

        //echo Auth::user()->name;

        return view('account', ['user'=> Auth::user()]);
    }

    public function postSaveAccount(Request $request){

        $this->validate($request, 
            [
                'name' => 'required|max:120'

            ]);

        $user = Auth::user();

        $user->name = $request['name'];
        $user->update();
        $file = $request->file('image');
        $filename = $request['name'].'-'.$user->id.'jpg';

        if($file){


            //store file
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()-> route('account');

    }

    public function getUserImage($filename){
        $file = Storage::disk('local')-> get($filename);

        return new Response($file, 200);
    }

    public function postLikePost(Request $request){

        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post =Post::find($post_id);
        if(!$post){
            return null;
        }

        $user = Auth::User();
        $like = $user->likes()->where('post_id', $post_id) ->first();

        if($like){

            $already_like = $like-like; 
            $update = true;

            if($already_like==$isLike){

                $like->delete(); 

                return null;

            }

        }
        else{
            $like = new Like();
        }

        $like -> like = $is_like;
        $like ->post_id = $post->id;

        if($update){
            $like ->update();

        }
        else{
            $like->save();
        }

        return null;
    }


}
