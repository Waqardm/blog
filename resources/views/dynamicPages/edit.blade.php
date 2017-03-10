@extends('main')

@section('title', 'Edit Page')

@section('stylesheets')

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
		{!! Form::model($pages, ['route' => ['dynamicPages.update', $pages->slug], 'method' => 'PUT', 'files' => true]) !!}
		<div class="col-md-8">
			{{ Form::label('title', 'Title:') }}
			{{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

			{{ Form::label('slug', 'Slug:', array('class' => 'form-spacing-top')) }}
			{{ Form::text('slug', null, array('class' => 'form-control')) }}

			{{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
			{{ Form::textarea('body', null, ['class' => 'form-control']) }}
		</div>

		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{ date('M j, Y h:i a', strtotime($pages->created_at)) }}</dd>
				</dl>

				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{ date('M j, Y h:i a', strtotime($pages->updated_at)) }}</dd>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{{ Html::linkRoute('dynamicPages.show', 'Cancel', array($pages->slug), array('class' => 'btn btn-danger btn-block')) }}
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
