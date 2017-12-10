<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	public function getRouteKeyName()
	{
		return 'alias';
	}

	public function tags()
	{
		return $this->belongsToMany('App\Tag')->withTimestamps();
	}

	public function tagsArray()
	{
		$tagsArray = [];

		$tags = $this->tags()->get();

		if( $tags )
		{
			foreach( $tags as $tag )
			{
				$tagsArray[$tag->alias] = $tag->title;
			}
		}

		return $tagsArray;
	}

	public function addView()
	{
		$this->views = ++ $this->views;
		$this->save();
	}
}
