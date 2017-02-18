<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Helpers\slugHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create variable and store all blog all posts in it from db
        $posts = Post::orderBy('id', 'desc')->paginate(5);

        //return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        // validate the data
        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'max:255',
                'body' => 'required'
            ));

        // store in db
        $post = new Post;

        $post->title = $request->title;
        //$post->slug =  $request->slug ? $request->slug : slugHelper::createSlug($request->title);
        //$post->slug = SlugHelper::checkSlugExists($request->slug);
        $slug = $request->slug ? $request->slug : slugHelper::createSlug($request->title);
        $post->slug = SlugHelper::checkSlugExists($slug);
        $post->body = $request->body;

        $post->save();

        //add flash message (current request only, put can be used for whole session)
        Session::flash('success', 'The blog post was successfully saved!');

        //redirect to another page
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in db and save as variable
        $post = Post::find($id);
        //return view and pass in the var we previously created
        return view('posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the data
        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'max:255',
                'body' => 'required'
            ));

        // Save the data to the db
        $post = Post::find($id);

        $post->title = $request->slug;
        $post->body = $request->input('body');

        $post->save();

        // Set flash data with success message
        Session::flash('success', 'This post was successfully saved!');

        // Redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        Session::flash('success', 'The post was successfully deleted.');
        return redirect()->route('posts.index');
    }
}
