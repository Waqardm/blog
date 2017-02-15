<?php

namespace App\Helpers;
use App\Post;

/**
* Slugs Class 
*/
class slugHelper{
	
	// check if exists
	public function checkSlugExists(){
		$name = 'checkSlugExists';
		$slug = Post::find('slug');
		return $slug;
		
		$found = true;
		$counter = 1;

		//if exists run while loop
		while($checkSlugExists){
			$slug = (str_slug($input . $counter++,  '-'));
			$found = false;
		 }
	}

	public static function createSlug($input){
		return(str_slug($input,'-'));
	}
}


// // check if exists
// public function checkSlugExists(){
// 	$name = 'checkSlugExists';
// 	$slug = Post::find('slug');
//     return $slug;
//     $found = true;
//     $counter = 1;
//  }

// //if exists run while loop
// while($found){
// 	$slug = (str_slug($input . $counter++  '-'));
// 	$found = false;
// }
		