<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Session;
use Mail;

class PagesController extends Controller {

	public function getIndex() {
		$posts = Post::orderBy('id', 'desc')->limit(4)->get();
		return view('pages.welcome')->withPosts($posts);
	}

	public function getAbout()
	{
		$first = 'Waqar';
		$last = 'Mohammad';

		$fullname = $first . " " . $last;
		$email = 'waqar@waqar.co';
		$data = [];
		$data['email'] = $email;
		$data['fullname'] = $fullname;
		return view('pages.about')->withData($data);
	}

	public function getContact()
	{
		return view('pages.contact');
	}

	public function postContact(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'subject' => 'min:3',
			'message' => 'min:10'
			]);

		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'bodyMessage' => $request->message
			);

		Mail::send('emails.contact', $data, function($message) use ($data){
			 $message->from($data['email']);
			 $message->to('waqar@waqar.co');
			 $message->subject($data['subject']);
			});
		
		return redirect('/')->with('success', 'Thanks! Your message has been sent');
	}

}


		#Example of controller actions
			#process variable data or params
			#talk to the model
			#receive data back from model
			#compile or process data from the model if needed
			#pass data to correct view

?>


		