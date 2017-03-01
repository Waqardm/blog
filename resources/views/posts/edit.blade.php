@extends('main')

@section('title', 'Edit Blog Post')

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
		{!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

			{{ Form::label('slug', 'Slug:', array('class' => 'form-spacing-top')) }}
			{{ Form::text('slug', null, array('class' => 'form-control')) }}

			{{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
			{{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

			{{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
			{{ Form::select('tags[]', $tags, null, ['class' => 'select2-multi form-control', 'multiple' => 'multiple']) }}

			{{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control']) }}
		</div>

		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date('M j, Y h:i a', strtotime($post->created_at)) }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:i a', strtotime($post->updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{{ Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) }}
					</div>
					<div class="col-sm-6">
						{{ Form::submit('Save Changes', array('class' => 'btn btn-success btn-block')) }}
					</div>
				</div>
			</div>
		</div>
		{!! Form::close()!!}
	</div>

@endsection

@section('scripts')

	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">

	  $('.select2-multi').select2();
	  $('.select2-multi').select2().val( {!! json_encode($post->tags->pluck('id')); !!}).trigger('change');﻿

	</script>

@endsection
