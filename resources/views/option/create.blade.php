@extends('layouts.plane')
@section('page_heading') @endsection
@section('content')


<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
     var x = 2;
  var fieldHTML = '<div class="form-group required"><label for="label" class="control-label col-sm-3">label:</label><div class="col-sm-3"><input id="label'+x+'" class="form-control" placeholder="label" name="option_value['+x+'][label]" type="text"> </div><label for="value" class="control-label col-sm-3">value:</label><div class="col-sm-3"><input id="value'+x+'" class="form-control" placeholder="value" name="option_value['+x+'][value]" type="text"> </div><label for="name" class="control-label col-sm-3">name:</label><div class="col-sm-3"><input id="name'+x+'" class="form-control" placeholder="name" name="option_value['+x+'][name]" type="text"> </div> <a href="javascript:void(0);" class="remove_button" title="Remove field">Remove</a></div>';
   
   //Initial field counter is 1
    $(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); // Add field html
        }
    });
    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>

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
 
        <legend>Legend</legend>
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
 
        <legend>Legend</legend>
                   
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
                    <a href="javascript:void(0);" class="add_button" title="Add field">Add more</a>
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
