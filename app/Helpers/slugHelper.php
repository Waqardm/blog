<?php

namespace App\Helpers;

/**
* Slugs Class 
*/
class slugHelper{
	public static function createSlug($input){
		
		//return (str_slug($input, '-'));	

		$i = 1;
		$slug = (str_slug("$input . $i++", '-'));

			while (isset($slug)){
		 	 return $slug;
		}
	}
}

		



/*class slugHelper{
	public static function createSlug($input){
		$i = 1;

		if ($input == ""){
		return(str_slug($input, '-'));
		} else {
			return(str_slug($input . '-' .$i++));
		}
	}
}*/

