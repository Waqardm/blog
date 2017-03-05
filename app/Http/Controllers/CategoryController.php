<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use Session;

class CategoryController extends Controller
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
        // display view of all categories
        // form to create new category
        $categories = Category::all();
        return view('categories.index')->withCategories($categories);
    }

    // *
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response

    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Save new category and redirect to index
        $this->validate($request, array(
            'name' => 'required|max:255',
            'slug' => 'max:255'
            ));

        $exist = Category::where('name', '=', $request->name)->first();

        if(!$exist)
        {
          $category = new Category;
          $category->name = $request->name;
          $category->slug = str_slug($category->name, '-');
          $category->save();

          Session::flash('success', 'New Category has been created!');
          return redirect()->route('categories.index');

        } else {
          Session::flash('danger', 'Category already exists! Please try another.');
          return redirect()->route('categories.index');
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
       $posts = Post::all();
       $category = Category::where('slug', '=', $slug)->first();
       return view('categories.show')->withCategory($category)->withPosts($posts)->withPaginate($paginate);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
