<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        LoginController::checkAuth();

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'alias' => 'required|unique:posts',
            'intro' => 'required',
            'content' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if( $validator->fails() )
        {
            return Redirect::to('posts/create')->withErrors($validator)->withInput();
        }
        else
        {
            $post = new Post();
            $post->title = Input::get('title');
            $post->alias = Input::get('alias');
            $post->intro = Input::get('intro');
            $post->content = Input::get('content');
            $post->read_more = Input::get('read_more', 'Read more');
            $post->views = 0;
            $post->status = Input::get('status');

            $post->save();

            Session::flash('message', 'Successfully created post!');

            return Redirect::to('/');
        }
    }

    /**
     *
     * Display the specified resource.
     *
     * @param Post $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
        LoginController::checkAuth();

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            // todo-caguct: unique alias!
            'alias' => 'required',
            'intro' => 'required',
            'content' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if( $validator->fails() )
        {
            dd($validator);
            return Redirect::to('posts/' . $post->alias . '/edit')->withErrors($validator)->withInput();
        }
        else
        {
            $post->title = Input::get('title');
            $post->alias = Input::get('alias');
            $post->intro = Input::get('intro');
            $post->content = Input::get('content');
            $post->read_more = Input::get('read_more', 'Read more');
            $post->status = Input::get('status');

            $post->save();

            Session::flash('message', 'Successfully update post!');

            return Redirect::to('posts/' . $post->alias . '/edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $alias
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($alias)
    {
        //
    }
}
