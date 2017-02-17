<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    public function setTitle($value){
    	$this->attributes['title'] = $value;
    	$this->attributes['slug'] = str_slug($value);
	}

	public function category(){
		return $this->belongsTo('App\Category');
	}
}
