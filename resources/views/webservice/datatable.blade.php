<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Data table start --> 
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>     
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- End datatable --> 
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 80vh;
                margin: 0;
            }
			td {
				color: #000;
				font-weight: 600;
			}
            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>

<body>
	<div class="container ">
		{{ csrf_field() }}
		<div class="table-responsive text-center">
			
			<div>
			<button class="add-modal btn btn-info"
							data-info="">
							<span class="glyphicon glyphicon-add"></span> Create
			</button>
			</div>
			
			<table class="table table-borderless" id="table">
				<thead>
					<tr>
						<th class="text-center">Id</th>
						<th class="text-center">First Name</th>
						<th class="text-center">Last Name</th>
						<th class="text-center">Gender</th>
						<th class="text-center">Name</th>
						<th class="text-center">Type</th>
						<th class="text-center">Languages</th>
						<th class="text-center">Phone</th>
						<th class="text-center">Email</th>
						<th class="text-center">Address</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				@foreach($data as $item)
				<tr class="item{{$item->contact_id}}">
					<td>{{$item->contact_id}}</td>
					<td>{{$item->first_name}}</td>
					<td>{{$item->last_name}}</td>
					<td>{{$item->gender}}</td>
					<td>{{$item->display_name}}</td>
					<td>{{$item->contact_type}}</td>
					<td>{{$item->languages}}</td>
					<td>{{$item->phone}}</td>
					<td>{{$item->email}}</td>
					<td>{{$item->street_address}}</td>
					<td><button class="edit-modal btn btn-info"
							data-info="{{$item->contact_id}},{{$item->first_name}},{{$item->last_name}},{{$item->gender}},{{$item->email}},{{$item->phone}},{{$item->street_address}}">
							<span class="glyphicon glyphicon-edit"></span> Edit
						</button>
						<button class="delete-modal btn btn-danger"
							data-info="{{$item->contact_id}},{{$item->first_name}},{{$item->last_name}},{{$item->gender}},{{$item->email}},{{$item->phone}},{{$item->street_address}}">
							<span class="glyphicon glyphicon-trash"></span> Delete
						</button>
						
												
						</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>

<!---Custom webservice Form --->	
<div  id="myModal" class="col-lg-12 modal fade " role="dialog" >
    <div class="panel panel-default filterable modal-dialog">
        <div class="panel-heading modal-content"> 
		<div class="modal-content">
            <div class="panel-title modal-header">Add new {{$title}}</div>
            
       
        <div class="panel-body">
            {{ Form::open(['route' => ['webservice.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            
             
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group required">
                        {{ Form::label('contact_id', 'Id:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
							{!! Form::text('contact_id', old('contact_id'), ['id' => 'contact_id','disabled' => 'disabled']) !!} 
                        </div>
                    </div>
                    
                    <div class="form-group required">
                        {{ Form::label('first_name', 'First Name:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('first_name', old('first_name'), ['id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name']) }}
                        </div>
                    </div>
                    <div class="form-group ">
                        {{ Form::label('last_name', 'Last Name:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('last_name', old('last_name'), ['id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('email', 'Email:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('email', old('email'), ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) }}
                        </div>
                    </div>                    
                    <div class="form-group required">
                        {{ Form::label('phone', 'Phone Number:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('phone', old('phone'), ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Phone Number']) }}
                        </div>
                    </div>
 

                    <div class="form-group required">
                        {{ Form::label('street_address', 'Street Address:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('street_address', old('street_address'), ['id' => 'street_address', 'class' => 'form-control', 'placeholder' => 'Street Address']) }}
                        </div>
                    </div>
 
                    

					 <div class="form-group required">
                        {{ Form::label('gender', 'Gender:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::select('gender', ['Male' => 'Male','Female' => 'Female'], old('status'), ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
  
                </div>
                      
            </div>
            <div class="form-group">
                {{ Form::label('', '', array('class' => 'control-label col-sm-3')) }}
                <div class="col-sm-6">
                    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
                    <a href="{{ URL::to('add') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
			</div>
        </div>
    </div>
</div>	
	
<!---Custom webservice Form --->	

	
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"></h4>

				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="fid" disabled>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="fname">First Name</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="fname">
							</div>
						</div>
						<p class="fname_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="lname">Last Name:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="lname">
							</div>
						</div>
						<p class="lname_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="email">Email</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email">
							</div>
						</div>
						<p class="email_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="gender">Gender</label>
							<div class="col-sm-10">
								<select class="form-control" id="gender" name="gender">
									<option value="" disabled selected>Choose your option</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="country">Country:</label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="country">
							</div>
						</div>
						<p
							class="country_error error text-center alert alert-danger hidden"></p>
						<div class="form-group">
							<label class="control-label col-sm-2" for="salary">Salary </label>
							<div class="col-sm-10">
								<input type="name" class="form-control" id="salary">
							</div>
						</div>
						<p
							class="salary_error error text-center alert alert-danger hidden"></p>
					</form>
					<div class="deleteContent">
						Are you Sure you want to delete <span class="dname"></span> ? <span
							class="hidden did"></span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn actionBtn" data-dismiss="modal">
							<span id="footer_action_button" class='glyphicon'> </span>
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class='glyphicon glyphicon-remove'></span> Close
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
  $(document).ready(function() {
    $('#table').DataTable();
    
} );
  </script>

	<script>
	
    $(document).on('click', '.add-modal', function() {
        $('#footer_action_button').text(" Add");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-add');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('add');
        $('.actionBtn').addClass('add');
        $('.modal-title').text('Add');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] +" "+stuff[2]);
        $('#myModal').modal('show');
    });

function fillmodalData(details){
    $('#fid').val(details[0]);
    $('#fname').val(details[1]);
    $('#lname').val(details[2]);
    $('#email').val(details[3]);
    $('#gender').val(details[4]);
    $('#country').val(details[5]);
    $('#salary').val(details[6]);
}

    $('.modal-footer').on('click', '.add', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'fname': $('#fname').val(),
                'lname': $('#lname').val(),
                'email': $('#email').val(),
                'gender': $('#gender').val(),
                'country': $('#country').val(),
                'salary': $('#salary').val()
            },
            success: function(data) {
            	if (data.errors){
                	$('#myModal').modal('show');
                    if(data.errors.fname) {
                    	$('.fname_error').removeClass('hidden');
                        $('.fname_error').text("First name can't be empty !");
                    }
                    if(data.errors.lname) {
                    	$('.lname_error').removeClass('hidden');
                        $('.lname_error').text("Last name can't be empty !");
                    }
                    if(data.errors.email) {
                    	$('.email_error').removeClass('hidden');
                        $('.email_error').text("Email must be a valid one !");
                    }
                    if(data.errors.country) {
                    	$('.country_error').removeClass('hidden');
                        $('.country_error').text("Country must be a valid one !");
                    }
                    if(data.errors.salary) {
                    	$('.salary_error').removeClass('hidden');
                        $('.salary_error').text("Salary must be a valid format ! (ex: #.##)");
                    }
                }
            	 else {
            		 
                     $('.error').addClass('hidden');
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                        data.id + "</td><td>" + data.first_name +
                        "</td><td>" + data.last_name + "</td><td>" + data.email + "</td><td>" +
                         data.gender + "</td><td>" + data.country + "</td><td>" + data.salary +
                          "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.email+","+data.gender+","+data.country+","+data.salary+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.email+","+data.gender+","+data.country+","+data.salary+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                  

            	 }}
        });
    });
    
    
    
  
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'fname': $('#fname').val(),
                'lname': $('#lname').val(),
                'email': $('#email').val(),
                'gender': $('#gender').val(),
                'country': $('#country').val(),
                'salary': $('#salary').val()
            },
            success: function(data) {
            	if (data.errors){
                	$('#myModal').modal('show');
                    if(data.errors.fname) {
                    	$('.fname_error').removeClass('hidden');
                        $('.fname_error').text("First name can't be empty !");
                    }
                    if(data.errors.lname) {
                    	$('.lname_error').removeClass('hidden');
                        $('.lname_error').text("Last name can't be empty !");
                    }
                    if(data.errors.email) {
                    	$('.email_error').removeClass('hidden');
                        $('.email_error').text("Email must be a valid one !");
                    }
                    if(data.errors.country) {
                    	$('.country_error').removeClass('hidden');
                        $('.country_error').text("Country must be a valid one !");
                    }
                    if(data.errors.salary) {
                    	$('.salary_error').removeClass('hidden');
                        $('.salary_error').text("Salary must be a valid format ! (ex: #.##)");
                    }
                }
            	 else {
            		 
                     $('.error').addClass('hidden');
                $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" +
                        data.id + "</td><td>" + data.first_name +
                        "</td><td>" + data.last_name + "</td><td>" + data.email + "</td><td>" +
                         data.gender + "</td><td>" + data.country + "</td><td>" + data.salary +
                          "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.email+","+data.gender+","+data.country+","+data.salary+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.first_name+","+data.last_name+","+data.email+","+data.gender+","+data.country+","+data.salary+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

            	 }}
        });
    });  
    
    
    
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
</script>

</body>
</html>
