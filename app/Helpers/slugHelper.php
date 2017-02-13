<?php

namespace App\Helpers;

/**
* Slugs Class 
*/
class slugHelper{
	public static function createSlug($input){
		return(str_slug($input, '-'));
	}
}


