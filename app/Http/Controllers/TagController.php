<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * @param Request $request
     */
    public function jsonSearch(Request $request)
    {
        $data = [];
        $tag = Input::get('tag');

        if( !empty($tag) )
        {
            $getTag = Tag::where('title', 'like', $tag . '%')->get();
            if( $getTag )
            {
                foreach( $getTag as $item )
                {
                    $data['tags'][] = $item->title;
                }
            }
        }

        return $data;
    }
}
