<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Auth;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showAllPosts() {

    	$varpost=Post::all();
    	return view('posts')->with('postview', $varpost);
    	// return view('posts')->withPostview($varpost);
    }
    public function createPost() {

    	return view('postform');
    }

    public function savePost(Request $request) {
    	
    	$this->validate($request, [

    			'title' => 'required|max:20',
    			'story' => 'required|max:100',
    		]);

    	$varpost=new Post;
    	$varpost->user_id=Auth::user()->id;
    	$varpost->title=$request->input('title');
    	$varpost->story=$request->input('story');

    	$varpost->save();

    	return redirect() ->route('post.index')->withSuccess('Post Created');
    }

    public function editPost(){


    }

    public function deletePost($id){

    	$varpost=Post::find($id);
    	// $varpost=Post::where([['id','=',$id],['user_id','=',Auth::user()->id]])->firdt();

    	if ($varpost) {
    		# code...
    		$varpost->delete();

    		return redirect()->route('post.index')->withSuccess('Post Successfully Delete');
    	}
    	else{
    		return redirect()->route('post.index')->withSuccess('Cannot Delete Post');
    	}
    }
}
