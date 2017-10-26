<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $data = [];
        $data['posts'] = Post::all();

        return view('home', compact('data'));
    }
}
