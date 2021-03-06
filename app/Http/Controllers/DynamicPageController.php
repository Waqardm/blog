<?php

namespace App\Http\Controllers;

use App\DynamicPage;
use App\Helpers\slugHelper;
use Illuminate\Http\Request;
use Purifier;
use Session;

class DynamicPageController extends Controller
{   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayPages()
    {
      return $pages = DynamicPage::where('slug', '=', $slug)->first();
    }

    public function index()
    {
        $pages = DynamicPage::all();
        return view('dynamicPages.index')->withPages($pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $pages = DynamicPage::all();
      return view('dynamicPages.create')->withPages($pages);
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
              'body' => 'required|min:10',
          ));

      // store in db
      $pages = new DynamicPage;
      $model = $pages;
      $pages->title = $request->title;
      $slug = $request->slug ? $request->slug : slugHelper::createSlug($request->title);
      $pages->slug = slugHelper::checkSlugExists($model, $slug);
      $pages->body = Purifier::clean($request->body);

      $pages->save();

      Session::flash('success', 'The Page was successfully saved!');

      //redirect to another page
      return redirect()->route('dynamicPages.show', $pages->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DynamicPage  $dynamicPage
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $pages = DynamicPage::where('slug', '=', $slug)->first();
        return view('dynamicPages.show')->withPages($pages);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DynamicPage  $dynamicPage
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $pages = DynamicPage::where('slug', '=', $slug)->first();
        return view('dynamicPages.edit')->withPages($pages);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DynamicPage  $dynamicPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, array(
          'title' => 'required',
          'body' => 'required',
        ));


        $pages =  DynamicPage::where('slug', '=', $slug)->first();

        $pages->title = $request->title;
        $pages->slug = str_slug($request->slug, '-');
        $pages->body = $request->body;

        $pages->save();

        Session::flash('success', 'Your Page has been updated');
        return redirect()->route('dynamicPages.show', $pages->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DynamicPage  $dynamicPage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pages = DynamicPage::find($id);
        $pages->delete();

        Session::flash('success', 'Your Page has been deleted.');
        return redirect()->route('dynamicPages.index');
    }
}
