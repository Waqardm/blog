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


	public static function checkSlugExists($slug) {
	   $exist = Post::where('slug', $slug)->first();

	   if(!$exist){  
	       return $slug;
	   }

	   $found = true;
	   $counter = 1;
	   while($found){	
	       $checkSlug = $slug.'-'.$counter; //not modifying but checking slug for existence
	       $exist = Post::where('slug',$checkSlug)->first();
	       
	       if (!$exist){
	       	$found = false;
	       }

	       $counter++;
	   }
		return $checkSlug;
	}
}