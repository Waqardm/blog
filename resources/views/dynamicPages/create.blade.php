@extends('main')

@section('title', 'Create New Page')

@section('stylesheets')

	{!! Html::style('css/select2.min.css') !!}
	<script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>

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

			    {{ Form::label('body', 'Post Body:', array('style' => 'margin-top:20px;')) }}
			    {{ Form::textarea('body', null, array('class' => 'form-control')) }}

			    {{ Form::submit('Create Page', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px;')) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('scripts')

	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">

	  $('.select2-multi').select2();

	</script>

@endsection
