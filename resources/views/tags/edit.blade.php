@extends('main')

@section('title', "Edit $tag->name Tag")

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">

			{{ Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) }}
		
				{{ Form::label('name', 'Name:') }}
				{{ Form::text('name', null, ['class' => 'form-control']) }}

				{{ Form::submit('Save Changes', ['class' => 'btn btn-success login-button-spacing']) }}

			{{ Form::close() }}

		</div>
	</div>



@endsection