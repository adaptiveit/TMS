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
            {{ Form::open(['route' => ['group.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            <div id="box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group required">
                       
                    </div>
                   
                    
                     <fieldset>
 
        <legend>Group Form</legend>
                    <div class="form-group required test">
                        {{ Form::label('Name', '	Name:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('name', old('name'), ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'name']) }}
                        <a href="#" id="add">Add More Input Field</a>
                        </div>
                    </div>
                   
                   
                 <div class="form-group required">
                        {{ Form::label('Title', '	Title:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('title', old('title'), ['id' => 'title', 'class' => 'form-control', 'placeholder' => 'title']) }}
                        </div>
                    </div>
                    
                    
                    
                    <div class="form-group required">
                        {{ Form::label('Description', '	Description:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('description', old('description'), ['id' => 'description', 'class' => 'form-control', 'placeholder' => 'description']) }}
                        </div>
                    </div>
                   
            
					 <div class="form-group required">
                        {{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::select('status', ['1' => 'Active','0' => 'Inactive'], old('status'), ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    
                    <div class="form-group required">
                        {{ Form::label('group', 'group:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::select('group', $id, old('status'), ['placeholder' => '- Select -', 'class' => 'form-control']) }}
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
            </div>
              </fieldset>
            {{ Form::close() }}
        </div>
    </div>
</div>



<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">Add new </div>
            
               <div class="pull-right">
                <a href="{{ URL::to('admin/fleettype') }}" class="btn btn-default btn-xs"><span class="fa  fa-arrow-circle-o-left"></span> Back</a>
            
            </div>
        </div>
        <div class="panel-body">
            {{ Form::open(['route' => ['option.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            <div id="box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group required">
                       
                    </div>
                   
                    
                     <fieldset>
 
        <legend>Option Group</legend>
                   
                    <div class="field_wrapper">
                   
                 <div class="form-group required">
                        {{ Form::label('label', '	label:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('option_value[0][label]', old('label'), ['id' => 'label0', 'class' => 'form-control', 'placeholder' => 'label']) }}
                        </div>
                        {{ Form::label('value', 'value:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('option_value[0][value]', old('value'), ['id' => 'value0', 'class' => 'form-control', 'placeholder' => 'value']) }}
                        </div>
                         {{ Form::label('name', 'name:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('option_value[0][name]', old('name'), ['id' => 'name0', 'class' => 'form-control', 'placeholder' => 'name']) }}
                        </div>
                    </div>
                    
                    
                    <div class="form-group required">
                        {{ Form::label('label', '	label:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('option_value[1][label]', old('label'), ['id' => 'label1', 'class' => 'form-control', 'placeholder' => 'label']) }}
                        </div>
                        {{ Form::label('value', 'value:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('option_value[1][value]', old('value'), ['id' => 'value1', 'class' => 'form-control', 'placeholder' => 'value']) }}
                        </div>
                         {{ Form::label('name', 'name:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('option_value[1][name]', old('name'), ['id' => 'name1', 'class' => 'form-control', 'placeholder' => 'name']) }}
                        </div>
                    </div>
                   
                    </div>
                    
                    
					 <div class="form-group required">
                        {{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::select('status', ['1' => 'Active','0' => 'Inactive'], old('status'), ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    
                    <div class="form-group required">
                        {{ Form::label('group', 'group:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::select('group', $id, old('status'), ['placeholder' => '- Select -', 'class' => 'form-control']) }}
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
            </div>
              </fieldset>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
