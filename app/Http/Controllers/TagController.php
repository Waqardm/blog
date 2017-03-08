<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Session;
use App\Helpers\slugHelper;
use App\Post;

class TagController extends Controller
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
        $tags = Tag::all();
        return view('tags.index')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|max:255'
            ));

        $exists = Tag::where('name', '=', $request->name)->first();

        if (!$exists)
        {

        $tag = new Tag;
        $model = $tag;
        $tag->name = $request->name;
        $slug = str_slug($tag->name, '-');
        $tag->slug = SlugHelper::checkSlugExists($tag, $slug);
        $tag->save();

        Session::flash('success', 'New Tag has been created!');
        return redirect()->route('tags.index');

        } else {

          Session::flash('danger', 'Category already exists! Please try another.');
          return redirect()->route('tags.index');

      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tag = Tag::where('slug', '=', $slug)->first();
        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
       $tag = Tag::where('slug', '=', $slug)->first();
       return view('tags.edit')->withTag($tag);
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
        $tag = Tag::find($id);

        $this->validate($request, ['name' => 'required|max:255']);

        $tag->name = $request->name;
        $tag->save();

        // success
        Session::flash('success', 'Tag sucessfully updated!');

        return redirect()->route('tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->posts()->detach();

        $tag->delete();

        Session::flash('success', 'Tag was deleted successfully');

        return redirect()->route('tags.index');
    }
}
