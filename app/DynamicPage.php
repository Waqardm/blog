<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class DynamicPage extends Model
{
  
	public static function menus()
    {

       return $menus = DynamicPage::all();
       
	}



}
