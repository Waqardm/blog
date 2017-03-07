<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Helpers\slugHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Category;
use Illuminate\Support\Facades\DB;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        //pulling categories for dropdown
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create')->withCategories($categories)->withTags($tags);
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
                'category_id' => 'required|integer',
                'tags' => 'required',
                'body' => 'required',
                'featured_image' => 'sometimes|image'
            ));

        // store in db
        $post = new Post;
        $model = $post;
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $slug = $request->slug ? $request->slug : slugHelper::createSlug($request->title);
        $post->slug = SlugHelper::checkSlugExists($model, $slug);
        $post->body = Purifier::clean($request->body);

        //save our image
        if ($request->hasFile('featured_image'))
        {
          $image = $request->file('featured_image');
          $filename =  time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->resize(800,400)->save($location);

          $post->image = $filename;
        }

        $post->save();

        // relations enabled
        $post->tags()->sync($request->tags, false);

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

        //pull categories
        $categories = Category::all();
        $cats = array();

        foreach ($categories as $category)
        {
            $cats[$category->id] = $category->name;
        }

        //pull tags
        $tags = Tag::all();
        $tags2 = array();

        foreach ($tags as $tag)
        {
            $tags2[$tag->id] = $tag->name;
        }


        //return view and pass in the var we previously created
        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
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
                'category_id' => 'required|integer',
                'tags' => 'required',
                'body' => 'required',
                'featured_image' => 'sometimes|image',
            ));

        // Save the data to the db
        $post = Post::find($id);

        $post->title = $request->slug;
        $post->category_id = $request->category_id;

        if (isset($request->tags))
        {
        //now set to 'true' so it overwrites existing data (can also be left blank)
            $post->tags()->sync($request->tags, true);
        } else {
            $post->tags()->sync(array());
        }

        $post->body = Purifier::clean($request->input('body'));

        if ($request->hasfile('featured_image'))
        {
          // add new photo
          $image = $request->file('featured_image');
          $filename =  time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->resize(800,400)->save($location);
          $oldFileName = $post->image;

          // update db to reflect new photo
          $post->image = $filename;

          // delete old photo
          Storage::delete('$oldFileName');
        }

        $post->save();


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
        $post->tags()->detach();
        Storage::delete($post->image);

        $post->delete();

        Session::flash('success', 'The post was successfully deleted.');
        return redirect()->route('posts.index');
    }
}
