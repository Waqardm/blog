<?php

namespace App\Http\Controllers;

class PagesController extends Controller {

	public function getIndex() {
		return view('pages.welcome');
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


		