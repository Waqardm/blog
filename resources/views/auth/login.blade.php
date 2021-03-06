@extends('main')

@section('title', 'Login')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::open() !!}
                
                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', null, ['class' => 'form-control']) }}

                {{ Form::label('password', 'Password:') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
                <br>
                {{ Form::checkbox('remember') }}{{ Form::label('remember', 'Remember Me', ['class' => 'remember-me']) }}

                {{ Form::submit('Login', ['class' => 'btn btn-primary form-control']) }}

            {!! Form::close() !!}
        </div>
    </div>

@endsection