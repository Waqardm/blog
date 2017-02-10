<?php

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {

	public function getIndex() {
		$posts = Post::orderBy('id', 'desc')->limit(4)->get();
		return view('pages.welcome')->withPosts($posts);
	}

	public function getAbout(){
		$first = 'Waqar';
		$last = 'Mohammad';

		$fullname = $first . " " . $last;
		$email = 'waqar@waqar.co';
		$data = [];
		$data['email'] = $email;
		$data['fullname'] = $fullname;
		return view('pages.about')->withData($data);
	}

	public function getContact(){
		return view('pages.contact');
	}

}


		#Example of controller actions
			#process variable data or params
			#talk to the model
			#receive data back from model
			#compile or process data from the model if needed
			#pass data to correct view

?>


		