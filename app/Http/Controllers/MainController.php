<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller {

	public function home()
	{
		$postCountOnPage = config('post.count');

		$data = [];
		if( LoginController::isAdmin() )
		{
			$data['posts'] = Post::orderBy('created_at', 'desc')->paginate($postCountOnPage);
		}
		else
		{
			$data['posts'] = Post::where('status', 'publish')->orderBy('created_at',
				'desc')->paginate($postCountOnPage);
		}

		$data['tags'] = Tag::where('frequency', '>', 0)->orderBy('frequency', 'desc')->get();

		return view('home', compact('data'));
	}
}
