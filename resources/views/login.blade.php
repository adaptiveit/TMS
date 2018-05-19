@extends('layouts.master')  
@section('page_heading') {{$title}} @endsection
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    @include('layouts.errors')
                    {{ Form::open(array('url' => 'admin/login', 'method' => 'POST')) }}
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                {{ Form::text('login', old('login'), ['id' => 'login', 'class' => 'form-control', 'placeholder' => 'E-mail/Username']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) }}
                            </div>
                            <div class="checkbox">
                                {{ Form::checkbox('remember', 1, null, ['id' => 'remember', 'class' => 'checkbox-inline']) }}
                                {{ Form::label('remember', 'Remember Me') }}
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        </fieldset>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop
