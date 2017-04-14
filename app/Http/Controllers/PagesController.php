<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function about()
    {
        return view('about');
    }

    public function content()
    {
        return view('content');
    }

    public function contact()
    {
        return view('contact');
    }
}
