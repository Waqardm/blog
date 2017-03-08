@extends('main')

@section('title', 'Categories')


@section('content')

	<div class="row">
		<div class="col-md-9">
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($categories as $category)
						<tr>
							<th> {{ $category->id}} </th>
							<td> <a href="{{ route('categories.show', $category->slug) }}">{{ $category->name }}</a> </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- end of .col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				{{ Form::open(['route' => 'categories.store']) }}

				<h2>New Category</h2>
				{{ Form::label('name', 'Name:') }}
				{{ Form::text('name', null, ['class' => 'form-control'] ) }}
				{{ Form::submit('Create New Category', ['class' => 'btn btn-primary btn-block login-button-spacing']) }}

				{{ Form::close() }}
			</div>
		</div>
	</div>

@endsection
