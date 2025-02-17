<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{

    
    //sebelum login
    public function welcome(){
        return view('welcome');
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        return view('contact');
    }
    
    //setelah login
    public function home(){
        return view('home');
    }

    public function bookshelf(){
        return view('bookshelf');
    }

    public function favorite(){
        return view('favorite');
    }

    public function chatcs(){
        return view('chatcs');
    }

    public function account(){
        return view('account');
    }
}
