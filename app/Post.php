<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public function setTitle($value)
    {
    	$this->attributes['title'] = $value;
    	$this->attributes['slug'] = str_slug($value);
	}

	public function category()
	{
		return $this->belongsTo('App\Category');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Tag', 'post_tag');
	}

	public function comments()
	{
		return $this->hasMany('App\Comment');
	}
}
