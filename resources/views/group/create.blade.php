@extends('layouts.plane')
@section('page_heading') @endsection
@section('content')

<script>

$(document).ready(function(){
	
	$('#add').click(function(){        
        var inp = $('.test');      
        var i = $('input').size() + 1;   
          
        $('<div class="form-group required test' + i +'"><input type="text" id="name" class="form-control" name="name' + i +'" placeholder="name '+i+'"/><img src="remove.png" width="32" height="32" border="0" align="top" class="add" id="remove" /> </div>').appendTo(inp);
        
        i++;
        
    });
    
     $('body').on('click','#remove',function(){
        
        $(this).parent('div').remove();

        
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
                   
                    <div class="form-group required test">
                        {{ Form::label('id', '	id:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-3">
                            {{ Form::text('id', old('id'), ['id' => 'id', 'class' => 'form-control', 'placeholder' => 'id']) }}
                        <a href="#" id="add">Add More Input Field</a>
                        </div>
                    </div>
                    
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
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
