@extends('main')

@section('title', 'Create New Post')

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
			<h1>Create New Post</h1>
			<hr>

			{!! Form::open(['route' => 'posts.store']) !!}
			    {{ Form::label('title', 'Title:') }}
			    {{ Form::text('title', null, array('class' => 'form-control')) }}

			    {{ Form::label('slug', 'Slug:', array('class' => 'form-spacing-top')) }}
			    {{ Form::text('slug', null, array('class' => 'form-control')) }}

			    {{ Form::label('category_id', 'Category:') }}
			    <select name="category_id" class="form-control">

			    	@foreach($categories as $category)

			    		<option value=" {{ $category->id }} "> {{ $category->name }} </option>

					@endforeach

			    </select>

			    {{ Form::label('tags', 'Tags:') }}
			    <select name="tags[]" class="form-control select2-multi" multiple="multiple">

			    	@foreach($tags as $tag)

			    		<option value=" {{ $tag->id }} "> {{ $tag->name }} </option>

					@endforeach

			    </select>

			    {{ Form::label('body', 'Post Body:', array('style' => 'margin-top:20px;')) }}
			    {{ Form::textarea('body', null, array('class' => 'form-control')) }}

			    {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top:20px;')) }}
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
