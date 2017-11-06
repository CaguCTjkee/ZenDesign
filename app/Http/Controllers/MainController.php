<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function home()
    {
        $data = [];
        if( LoginController::isAdmin() )
            $data['posts'] = Post::orderBy('created_at', 'desc')->get();
        else
            $data['posts'] = Post::where('status', 'publish')->orderBy('created_at', 'desc')->get();

        return view('home', compact('data'));
    }
}
