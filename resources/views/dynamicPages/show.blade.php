@extends('main')

@section('title', 'View Post')

@section('content')
	<div class="row">

		@if(!Auth::check())
  			<div class="col-md-10 col-md-offset-1 panel panel-default">
  		@else
  			<div class="col-md-8 panel panel-default">
  		@endif
  		
  			<h1>{{ $pages->title }}</h1>

					<div class="card">
						<p class="lead">{!! $pages->body !!}</p>
					</div>

  			<hr>
  		</div>
		@if (Auth::check())
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal form-group" >
					<label>Url:</label>
					<p><a href="{{ route('dynamicPages.show', $pages->slug) }}">{{ route('dynamicPages.show', $pages->slug) }}</a></p>
				</dl>

				{{-- <dl class="dl-horizontal form-group">
					<label>Category:</label>
					<p> {{ $pages->category->name }} </p>
				</dl> --}}

				<dl class="dl-horizontal">
					<label>Created At:</label>
					<p>{{ date('M j, Y h:i a', strtotime($pages->created_at)) }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Last Updated:</label>
					<p>{{ date('M j, Y h:i a', strtotime($pages->updated_at)) }}</p>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkRoute('dynamicPages.edit', 'Edit', array($pages->slug), ['class' => 'btn btn-primary btn-block']) !!}
					</div>
					<div class="col-sm-6">
						{!!	Form::open(['route' => ['dynamicPages.destroy', $pages->id], 'method' => 'DELETE']) !!}

						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
					</div>
				</div>
			

				<div class="row">
					{{ Html::linkRoute('dynamicPages.index', '<< See All Pages', [], ['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
				</div>
				@endif
			</div>
		</div>
	</div>

@endsection
