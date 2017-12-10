<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	public function getRouteKeyName()
	{
		return 'alias';
	}

	public function posts()
	{
		return $this->belongsToMany('App\Post')->withTimestamps();
	}

	/**
	 * @param array $get_tags
	 *
	 * @return array|bool
	 */
	static function addTagsFromArray(array $get_tags)
	{
		if( $get_tags )
		{
			$tags = [];

			foreach( $get_tags as $tag_title )
			{
				$tag = Tag::where('title', $tag_title)->orWhere('alias', $tag_title)->get()->first();
				if( $tag === null )
				{
					// Add tag
					$tag        = new Tag();
					$tag->title = $tag_title;
					$tag->alias = \Slug::make($tag_title);
					$tag->save();
				}
				$tags[] = $tag;
			}

			if( $tags )
			{
				return $tags;
			}
		}

		return false;
	}

	static function tagsUpdateFrequency()
	{
		$tags = self::get();

		foreach( $tags as $tag )
		{
			$tag->frequency = $tag->posts()->count();
			$tag->save();
		}
	}
}
