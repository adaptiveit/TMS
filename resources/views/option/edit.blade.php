@extends('layouts.plane')
@section('page_heading') @endsection
@section('content')
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>

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
                <a href="{{ URL::to('admin/option') }}" class="btn btn-default btn-xs"><span class="fa  fa-arrow-circle-o-left"></span> Back</a>
            
            </div>
        </div>
        <div class="panel-body">
            {{ Form::open(['route' => ['option.update',$data->id], 'method' => 'put', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            <div id="box">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group required">
                       
                    </div>
                   
                    
                    
                                             
                      <div class="container-fluid">
  <div class="row">
    <div class="col bg-successff">
		{{ Form::label('id', 'id:', array('class' => 'control-label')) }}
                        <div class="col-sm-kkk">
                            {{ Form::text('id', $data->id, ['id' => 'id', 'class' => 'form-control', 'placeholder' => 'id']) }}
                     
                        </div>
    </div>
    <div class="col bg-warningff">
		{{ Form::label('group', 'group:', array('class' => 'control-label col-s')) }}
                        <div class="col-sm">
                            {{ Form::select('group', ['1' => '1'], $data->option_group_id, ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
    </div>
    <div class="col bg-successee">
		{{ Form::label('label', 'label:', array('class' => 'control-label')) }}
                        <div class="col-sm-kkk">
                            {{ Form::text('label', $data->label, ['id' => 'label', 'class' => 'form-control', 'placeholder' => 'label']) }}
                       
                        </div>
    
    </div>
  </div>
</div>                  
      
        
                   
        
        
                   
      <div class="container-fluid">
  <div class="row">
    <div class="col">
		<div class="col-sm-kkk test">
                            {{ Form::text('value', $data->value, ['name' => 'value[]', 'class' => 'form-control', 'placeholder' => 'value']) }}
                            
                             <a href="#" id="add">Add More Input Field</a>
                   
                        </div>
    </div>
    <div class="col bg-warninghhh">
		{{ Form::label('name', 'name:', array('class' => 'control-label')) }}
                        <div class="col-sm-kkk">
                            {{ Form::text('name', $data->name, ['id' => 'name', 'class' => 'form-control', 'placeholder' => 'name']) }}
                       
                        </div>
    </div>
    
     <div class="col bg-warningjjj">
		{{ Form::label('grouping', 'grouping:', array('class' => 'control-label')) }}
                        <div class="col-sm-kkk">
                            {{ Form::text('grouping', $data->grouping, ['id' => 'grouping', 'class' => 'form-control', 'placeholder' => 'grouping']) }}
                       
                        </div>
    </div>
    
    
    </div>
  </div>
</div>   



 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
		{{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm">
                            {{ Form::select('status', ['1' => 'Active','0' => 'Inactive'], $data->status, ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
    </div>
    
    
    
    
    </div>
  </div>
</div>                
                   
                   
                   
            
            <div class="form-group">
                {{ Form::label('', '', array('class' => 'control-label col-sm-3')) }}
                <div class="col-sm-6">
                    {{ Form::submit('Submit', ['class' => 'btn btn-default btn btn-primary']) }}
                 
                </div>
            </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop

