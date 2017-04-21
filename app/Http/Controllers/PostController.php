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
    public function showAllPosts(Request $request) {

        // dd($request->searchtext);
    	// $varpost=Post::all();
    	$varpost=Post::where([
    		['user_id','=',Auth::user()->id]
    	]);
        // $varpost=Post::where('id','=','0');
        // $varpost=new Post;
        if (!empty($request->searchtext)) {
            # code...
            $varpost=$varpost->whereTitle($request->searchtext);

        }

        if (!empty($request->searchStory)) {
            # code...

            $varpost=$varpost->where('story','LIKE',"%$request->searchStory%");
        }

        if (!empty($request->searchId)) {
            # code...
            $varpost=$varpost->whereId($request->searchId);
        }
    	
        $varpost=$varpost->paginate(5);

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

    public function editPost($id){

    	$varpost=Post::where([
    		['id','=',$id], 
    		['user_id','=',Auth::user()->id]
    		])->first();
                                
    	return view('editform')->withId($id)->withPost($varpost);
    }
    
    public function updatePost(Request $request, $id){

    	$this->validate($request, [

    			'title' => 'required|max:20',
    			'story' => 'required|max:100',
    		]);

    	$varpost=Post::where([
    		['id','=',$id], 
    		['user_id','=',Auth::user()->id]
    		])->first();

    	if ($varpost) {
    		# code...
    		$varpost->title=$request->input('title');
    		$varpost->story=$request->input('story');
    		$varpost->save();

    		return redirect()->route('post.index')->withSuccess('Post Successfully Update');
    	}
    	else{
    		return redirect()->route('post.index')->withSuccess('Cannot Update Post');
    	}
    }

    public function deletePost($id){

    	$varpost=Post::find($id);
    	// $varpost=Post::where([['id','=',$id],['user_id','=',Auth::user()->id]])->first();

    	if ($varpost) {
    		# code...
    		$varpost->delete();

    		return redirect()->route('post.index')->withSuccess('Post Successfully Delete');
    	}
    	else{
    		return redirect()->route('post.index')->withSuccess('Cannot Delete Post');
    	}
    }

    public function searchPosts(Request $request) {

        $searchtext=$request->input('searchtext');
        $searchopt=$request->input('searchopt');

        if (!empty($searchtext)) {
            # code...
            switch ($searchopt) {
                case 'id':
                    # code...
                    $res=Post::where([['id','=',$searchtext]])->get();
                    break;
                
                case 'title':
                    #code...
                    $searchtext='%'.$searchtext."%";
                    $res=Post::where([['title','like',$searchtext],['user_id','=',Auth::user()->id]])->get();
                    break;

                case 'story':
                    #code
                    $searchtext='%'.$searchtext."%";
                    $res=Post::where([['story','like',$searchtext],['user_id','=',Auth::user()->id]])->get();
                    break;

                default:
                    # code...
                    $searchtext='%'.$searchtext."%";
                    $res=Post::where([['id','like',$searchtext],['user_id','=',Auth::user()->id]])->get();
                    break;
            }
        }
        else{
            $res=Post::where([
            ['user_id','=',Auth::user()->id]
        ])->get();;
            // $res=Post::all();
        }

        // return redirect()->route('post.index')->withPost($res);
        return view('posts')->withPostview($res);
    }
}
