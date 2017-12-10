<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller {

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
			'title'   => 'required',
			'alias'   => 'required|unique:posts',
			'intro'   => 'required',
			'content' => 'required',
			'status'  => 'required',
		);

		// Prepere alias
		Input::merge([
			'alias' => $this->prepareAlias(Input::get('alias')),
		]);

		$validator = Validator::make(Input::all(), $rules);

		if( $validator->fails() )
		{
			return Redirect::to('posts/create')->withErrors($validator)->withInput();
		}
		else
		{
			$post            = new Post();
			$post->title     = Input::get('title');
			$post->alias     = Input::get('alias');
			$post->intro     = Input::get('intro');
			$post->content   = Input::get('content');
			$post->read_more = Input::get('read_more', 'Read more');
			$post->views     = 0;
			$post->status    = Input::get('status');

			$post->save();

			// Attach a tag to the post
			$this->postTags(Input::get('tag'), $post);

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
		// Views
		$post->addView();

		if( $post->status !== 'publish' )
		{
			LoginController::checkAuth();
		}

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
		if( LoginController::isAdmin() === false )
		{
			return Redirect::to('/admin');
		}

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
			'title'   => 'required',
			'alias'   => 'required|unique:posts,alias,' . $post->id,
			'intro'   => 'required',
			'content' => 'required',
			'status'  => 'required',
		);

		// Prepere alias
		Input::merge([
			'alias' => $this->prepareAlias(Input::get('alias')),
		]);

		$validator = Validator::make(Input::all(), $rules);

		if( $validator->fails() )
		{
			return Redirect::to('posts/' . $post->alias . '/edit')->withErrors($validator)->withInput();
		}
		else
		{
			$post->title     = Input::get('title');
			$post->alias     = Input::get('alias');
			$post->intro     = Input::get('intro');
			$post->content   = Input::get('content');
			$post->read_more = Input::get('read_more', 'Read more');
			$post->status    = Input::get('status');
			$post->save();

			// Attach a tag to the post
			$this->postTags(Input::get('tag'), $post);

			Session::flash('message', 'Successfully update post!');

			return Redirect::to('posts/' . $post->alias . '/edit');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Post $post
	 *
	 * @return mixed
	 * @throws \Exception
	 */
	public function destroy(Post $post)
	{
		LoginController::checkAuth();

		$post->delete();

		Session::flash('message', 'Successfully delete post!');

		return Redirect::to('/');
	}

	/**
	 * Attach a tag to the post
	 *
	 * @param      $tags
	 * @param Post $post
	 */
	public function postTags($tags, Post $post)
	{
		if( $tags )
		{
			$tags = Tag::addTagsFromArray($tags);
			if( $tags )
			{
				// Remove all tags from the post
				$post->tags()->detach();

				foreach( $tags as $tag )
				{
					// Attach a tag to the post
					$post->tags()->attach($tag);
				}

				// Update all tags frequency
				Tag::tagsUpdateFrequency();
			}
		}
	}

	/**
	 * @param $alias
	 *
	 * @return string
	 */
	public function prepareAlias($alias)
	{
		$alias = strtolower(\Slug::make($alias));

		return $alias;
	}
}
