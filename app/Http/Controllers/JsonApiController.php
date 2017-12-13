<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class JsonApiController extends Controller
{
    /**
     * Tag search
     *
     * @param Request $request
     *
     * @return array
     */
    public function tagSearch(Request $request)
    {
        $data = [];
        $tag = Input::get('tag');

        if( !empty($tag) )
        {
            $getTag = Tag::where('title', 'like', $tag . '%')->orWhere('alias', 'like', $tag . '%')->get();
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

    /**
     * Live translation
     *
     * @param Request $request
     *
     * @return array
     */
    public function liveTranslation(Request $request)
    {
        $data = [];

        $value = Input::get('value');

        if( !empty($value) )
        {
            $data['value'] = \Slug::make($value);
        }

        return $data;
    }
}
