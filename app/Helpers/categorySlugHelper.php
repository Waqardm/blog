<?php

namespace App\Helpers;
use App\Post;
use App\Category;

class categorySlugHelper{
	public static function createCategorySlug($category){
		return(str_slug($category->name,'-'));
	}

  
