<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Auth;

class AdminController extends Controller
{

    public function login(){
        return view('admin.dashboard');
    }

    public function editProfile($id){

    	$varpost=User::where([
    		['id','=',$id]
    		])->first();

    	return view('admin.profile')->withId($id)->withPost($varpost);;
    }

    public function updProfile(Request $request, $id){
    	$this->validate($request, [

    		'name' => 'required|max:20',
    		'email' => 'required|max:50',
    	]);
    	
    	$varpost=User::where([
    		['id','=',$id]
    		])->first();

    	if ($varpost) {
    		# code...
    		$varpost->name=$request->input('name');
    		$varpost->email=$request->input('email');
    		$varpost->save();

    		return redirect()->route('post.index')->withSuccess('Profile Successfully Update');
    	}
    	else{
    		return redirect()->route('post.index')->withSuccess('Cannot Update Profile');
    	}
    }
}
