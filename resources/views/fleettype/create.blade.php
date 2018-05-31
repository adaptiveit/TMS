@extends('layouts.plane')
@section('page_heading') @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">Add new </div>
            
               <div class="pull-right">
                <a href="{{ URL::to('admin/fleettype') }}" class="btn btn-default btn-xs"><span class="fa  fa-arrow-circle-o-left"></span> Back</a>
            
            </div>
        </div>
        <div class="panel-body">
            {{ Form::open(['route' => ['fleettype.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group required">
                       
                    </div>
                    <div class="form-group required">
                        {{ Form::label('fleet_type', '	fleettype:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('fleet_type', old('fleet_type'), ['id' => 'fleet_type', 'class' => 'form-control', 'placeholder' => 'fleettype']) }}
                        </div>
                    </div>
                   
                   
                 <div class="form-group required">
                        {{ Form::label('fleet_id', '	fleetid:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('fleet_id', old('fleet_id'), ['id' => 'fleet_id', 'class' => 'form-control', 'placeholder' => 'fleetid']) }}
                        </div>
                    </div>
                   
            
					 <div class="form-group required">
                        {{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::select('status', ['1' => 'Active','0' => 'Inactive'], old('status'), ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    
                </div>
                
            </div>
            <div class="form-group">
                {{ Form::label('', '', array('class' => 'control-label col-sm-3')) }}
                <div class="col-sm-6">
                    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
                 
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
