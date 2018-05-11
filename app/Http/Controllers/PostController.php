<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

/**
* 
*/
class PostController extends Controller
{
	
	public function getDeletePost($post_id)
	{

		$post = Post::where('id', $post_id)->first();

		if(Auth::user()!= $post->user)
			{
				return redirect()->back() ->with(['message' => "You are not allowed to delete that post"]);

			}

		$post->delete();

		return redirect() ->route('dashboard')->with(['message'=> 'Delete successful']);
	}

	public function getDashboard(){

		$posts = Post::orderby('created_at', 'desc')->get();

		return view('dashboard', ['posts' => $posts]);

	}
	public function postCreatePost(Request $request)
	{
		$this-> validate($request,  
			[
				'body' => 'required|max:1000'
			]
		);
		$post = new Post;
		$post->body = $request['body'];

		if($request->user()->posts()->save($post))
			{
				$message = 'Post successfully Created!';
			}

		return redirect()->route('dashboard') ->with(['message' => $message]);

	}
	public function postEditPost(Request $request){
		$this->validate($request, 
			[
				'body' => 'required'

			]);
		
		$post = Post::find($request['postId']);
		
		if(Auth::user() != $post-> user){
			return redirect()->back();
		}

		$post->body = $request['body'];

		$post->update();

		return response() ->json(['new-body' => $post->body], 200);
	}
}