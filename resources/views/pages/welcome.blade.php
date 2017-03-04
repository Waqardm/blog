@extends('main')
@section('title', 'Home')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                  <h1>Welcome to My Blog!</h1>
                  <p class="lead">Thanks you so much for visiting. This is my test website built with Laravel. Please read the popular post!</p>
                  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
                </div>
            </div>
        </div> <!-- end of header .row -->

        <div class="row">
          <div class="col-md-8">
              @foreach($posts as $post)
                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "...": "" }}</p>
                    <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read More</a>
                </div>
                <hr>
              @endforeach
          </div>

          <div class="col-md-3 col-md-offset-1">
            <h2>Sidebar</h2>
            <hr>
            <div class="col-md-offset-1">
                <h4>Categories</h4>
                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a><br/>
                @endforeach
            </div>
          </div>

        </div>
@endsection
