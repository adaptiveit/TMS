@extends('layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">Edit {{$title}}</div>
            <div class="pull-right">
                <a href="{{ URL::to('admin/user') }}" class="btn btn-default btn-xs"><span class="fa  fa-arrow-circle-o-left"></span> Back</a>
            </div>
        </div>
        <div class="panel-body">
            {{ Form::open(['route' => ['user.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                   
                   
                    <div class="form-group required">
                        {{ Form::label('role', 'Role:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::select('role', $roles, $user->role_id, ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('user_name', 'Username:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('user_name', $user->user_name, ['id' => 'user_name', 'class' => 'form-control', 'placeholder' => 'Username']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('email', 'Email:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::email('email', $user->email, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) }}
                        </div>
                    </div> 
                    <div class="form-group">
                        {{ Form::label('password', 'Password:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) }}
                        </div>
                    </div>
                    
                    <div class="form-group required">
                        {{ Form::label('name', 'Name:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('name', $user->name, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'Name']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::select('status', ['1' => 'Active','0' => 'Inactive'], $user->status, ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="form-group">
                {{ Form::label('', '', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-6">
                    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
                    <a href="{{ URL::to('admin/user') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@stop