@extends('main')

@section('title', 'Create New Page')

@section('stylesheets')

	<script>
			tinymce.init({
				selector: 'textarea',
				plugins: 'link code',
				menubar: 'false'
			});
	</script>

@endsection

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Page</h1>
			<hr>

			{!! Form::open(['route' => 'dynamicPages.store']) !!}
			    {{ Form::label('title', 'Title:') }}
			    {{ Form::text('title', null, array('class' => 'form-control')) }}

			    {{ Form::label('slug', 'Slug:', array('class' => 'form-spacing-top')) }}
			    {{ Form::text('slug', null, array('class' => 'form-control')) }}

			    {{ Form::label('body', 'Page Body:', array('style' => 'margin-top:20px;')) }}
			    {{ Form::textarea('body', null, array('class' => 'form-control')) }}

			    {{ Form::submit('Create Page', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px;')) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection
