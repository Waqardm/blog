@extends('main')

@section('title, Pages List')

@section('content')

  <div class="row">
    <div class="col-md-8">
      <h1>All Pages</h1>
    </div>

    <div class="col-md-2 col-md-offset-1">
      <a href="{{ route('dynamicPages.create') }}" class="btn btn-lg btn-primary btn-h1-spacing">Create New Page</a>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
  </div> <!-- end of .row -->

  <div class="row">
    <div class="col-md-12">
      <table class="table">
        <thead>
          <th>#</th>
          <th>Title</th>
          <th>Body</th>
          <th>Created At</th>
          <th></th>
        </thead>

         <tbody>

          @foreach ($pages as $page)

            <tr>
              <th>{{ $page->id }}</th>
              <td>{{ $page->title }}</td>
              <td>{{ substr(strip_tags($page->body), 0, 50) }} {{ strlen(strip_tags($page->body)) > 50 ? "..." : "" }} </td>
              <td>{{ date('M j, Y', strtotime($page->created_at)) }}</td>
              <td>
                <a href="{{ route('dynamicPages.show', $page->slug) }}" class="btn btn-default btn-sm">View</a>
                <a href="{{ route('dynamicPages.edit', $page->slug) }}" class="btn btn-default btn-sm">Edit</a>
              </td>
            </tr>

          @endforeach

        </tbody>
      </table>
      <div class="text-center">
        {!! $pages->links(); !!}
      </div>
    </div>
  </div>


@endsection
