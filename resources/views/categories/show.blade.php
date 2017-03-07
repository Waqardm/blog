@extends('main')

@section('title', "Category")

@section('content')

  <div class="row">
    <div class="col-md-8 col-md-offset-2 categories-show">
      <h2> Posts from the {{ $category->name }} Category <small>({{ $category->posts->count() }})</small></h2>
    </div>


    @foreach ($category->posts as $post)
      <div class="col-md-8 col-md-offset-2">
        <h3>{{ $post->title }}</h2>
        <h5 class="publish-time">Published: {{ date('M j, Y', strtotime($post->created_at)) }}</h5>

        <p>{{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 250 ? '...' : "" }} </p>

        <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read More</a>
        <hr>
      </div>
    @endforeach

  </div>
@endsection
