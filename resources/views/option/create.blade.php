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

/*$(document).ready(function(){
	
	var max_fields_limit      = 10; //set limit for maximum input fields
    var x = 2; //initialize counter for text box
    $('#add').click(function(e){ //click event on add more fields button having class add_more_button
        e.preventDefault();
        
        if(x < max_fields_limit){ //check conditions
            x++; //counter incrementalert();
            
            alert(x);
            $('.test').append('<div class="col-sm-4"><input name="value['+ x +']" class="form-control" placeholder="value" type="text" id="value"><input name="name['+x+']" class="form-control" placeholder="name" type="text"><input name="grouping['+x+']" class="form-control" placeholder="grouping" type="text"><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div>'); //add input field
            
        }
    });  
    $('.test').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })

	

	        
});*/

$(document).ready(function(){
	var maxField = 10;
	 var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var x = 3;
    var fieldHTML = '<div><input name="value['+x+']" class="" placeholder="value" type="text"><a href="javascript:void(0);" class="remove_button" title="Remove field">Remove</a></div>'; //New input field html 
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
            {{ Form::open(['route' => ['option.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            <div id="box">
            <div class="row">
                <div class="col-sm-12 test">
                   
                   
                    
                    
                                             
                      <div class="container-fluid">
  <div class="row">
    <div class="col bg-successff">
		{{ Form::label('id', 'id:', array('class' => 'control-label')) }}
                        <div class="col-sm-kkk">
                            {{ Form::text('id', old('id'), ['name' => 'id[]', 'class' => 'form-control', 'placeholder' => 'id']) }}
                     
                        </div>
    </div>
    <div class="col bg-warningff">
		{{ Form::label('group', 'group:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm">
                            {{ Form::select('group', $id, old('status'), ['name' => 'group[]','placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
    </div>
    <div class="col bg-successee">
		{{ Form::label('label', 'label:', array('class' => 'control-label')) }}
                        <div class="col-sm-kkk">
                            {{ Form::text('label', old('label'), ['name' => 'label[]', 'class' => 'form-control', 'placeholder' => 'label']) }}
                       
                        </div>
    
    </div>
  </div>
</div>                  
      
        
                   
        
        
                   
      <div class="container-fluid">
		  <div class="field_wrapper">
  <div class="row ">
    <div class="col">
		{{ Form::label('value', 'value:', array('class' => 'control-label')) }}
                        <div class="col-sm-kkk">
                            {{ Form::text('value[]', old('value'), ['name' => 'value[]', 'class' => 'form-control', 'placeholder' => 'value']) }}
                            {{ Form::text('value[]', old('value'), ['name' => 'value[]', 'class' => 'form-control', 'placeholder' => 'value']) }}
                           
                           {{ Form::text('value[]', old('value'), ['name' => 'value[]', 'class' => 'form-control', 'placeholder' => 'value']) }}
                           
                           
                             
                   
                        </div>
    </div>
    <div class="col">
		{{ Form::label('name', 'name:', array('class' => 'control-label')) }}
                        <div class="col-sm-kkk">
                            {{ Form::text('name[]', old('name'), ['name' => 'name[0]', 'class' => 'form-control', 'placeholder' => 'name']) }}
                             
                        </div>
    </div>
    
     <div class="col">
		{{ Form::label('grouping', 'grouping:', array('class' => 'control-label')) }}
                        <div class="col-sm-kkk">
                            {{ Form::text('grouping[]', old('grouping'), ['name' => 'grouping[0]', 'class' => 'form-control', 'placeholder' => 'grouping']) }}
                          
                        </div>
    </div>
    
    
    </div>
  </div>
</div>   


<a href="javascript:void(0);" class="add_button" title="Add field">Add more</a>

 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-4">
		{{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm">
                            {{ Form::select('status', ['1' => 'Active','0' => 'Inactive'], old('status'), ['name' => 'status[]','placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
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

