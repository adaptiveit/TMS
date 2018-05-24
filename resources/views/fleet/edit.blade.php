@extends('admin::layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">Edit {{$title}}</div>
            <div class="pull-right">
                <a href="{{ URL::to('admin/client') }}" class="btn btn-default btn-xs"><span class="fa  fa-arrow-circle-o-left"></span> Back</a>
            </div>
        </div>
        <div class="panel-body">
            {{ Form::open(['route' => ['admin.client.update', $client->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            <div class="form-group required">
                    {{ Form::label('app_name', 'App Name:', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-6">
                        {{ Form::text('app_name', $client->app_name, ['id' => 'app_name', 'class' => 'form-control', 'placeholder' => 'App name']) }}
                    </div>
                </div>
                <div class="form-group required">
                    {{ Form::label('app_key', 'App Key:', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-6">
                        {{ Form::text('app_key', $client->app_key, ['id' => 'app_key', 'class' => 'form-control', 'placeholder' => 'App key', 'rows' => '3'] ) }}
                    </div>
                </div>
            <div class="form-group">
                {{ Form::label('', '', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-6">
                    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
                    <a href="{{ URL::to('admin/client') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@stop