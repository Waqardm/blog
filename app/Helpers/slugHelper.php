<?php

namespace App\Helpers;
use App\Post;

/**
* Slugs Class 
*/
class slugHelper{
	public static function createSlug($input){
		return(str_slug($input,'-'));
	}

	public static function checkSlugExists($slug){
		//check it if exists
		$exist = Post::where('slug', $slug)->first();

		// Assign slug if doesn't exist

		if(!$exist) {
			return $slug;
		}

		$found = true;
		$counter = 1;

		while ($found){
			//check slug variable 
			$checkSlug = $slug . "-" . $counter;

			//check slug exists
			$exist = Post::where('slug', $checkSlug)->first();

			//if exists
			if (!$exist) {
				$found = false;
			}

			$counter++;
		}
		return $checkSlug;
	}
}