<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function home(){
        return view('home');
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
