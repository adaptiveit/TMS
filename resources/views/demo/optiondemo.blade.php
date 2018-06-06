@extends('layouts.plane')
@section('page_heading')  @endsection
@section('content')
<!-- Datatables Start-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
	
<!-- Datatables New-->	
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">	
<!-- Datatables End-->
	
<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
			
			
            <div class="panel-title">Edit List</div>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                @if(AdminHelper::checkPermission('user_add'))
                <a href="{{ URL::to('admin/option/create') }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Add new</a>
                @endif
                
            </div>
        </div>
        <div class="panel-body">   
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="filters">
							<th><input type="text" class="form-control" placeholder="Id" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Name" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Group Name" disabled></th>
                             <th><input type="text" class="form-control" placeholder="Group Id" disabled></th>
                              
                            <th>Action</th>
                        </tr>
                    </thead>
                  
                    <tbody>
                        @foreach($options as $key => $option)
                      
                        <tr>
							 <td>{{ $option->id }}</td>
                             <td>{{ $option->value }}</td>
                             <td>{{ $option->name }}</td>
                             <td>{{ $option->option_group_id }}</td>
                             
                           
                            
                           <td>@if($option->status == 1)Yes @else No @endif</td>
                            <td>
                                <span class="btn-group">
                                    @if(AdminHelper::checkPermission('user_edit'))
                                    <a href="{{ route('option.edit', $option->id) }}" class="xcrud-action btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    @endif
                                    @if(AdminHelper::checkPermission('user_delete'))
                                    {{ Form::open(array('route' => array('option.destroy', $option->id), 'method' => 'DELETE')) }}
                                    <button type="submit" class="xcrud-action btn btn-danger btn-sm" title="Remove"><i class="fa fa-trash-o"></i></button>
                                    {{ Form::close() }}
                                    @endif
                                </span>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                
                
                
				@section('content')
					<table class="table table-bordered table-hover" id="orders-table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Group Name</th>
								<th>Group Id</th>
							</tr>
						</thead>
					</table>
				@endsection

				@push('scripts')
				<script type="text/javascript">
					$('#orders-table').DataTable({
						"processing": true,
						"serverSide": true,
						"ajax": '{!! route('demo.optiondemo') !!}',
						"columns": [
							{ data: 'id', name: 'id' },
							{ data: 'value', name: 'value' },
							{ data: 'name', name: 'name' },
							{ data: 'option_group_id', name: 'option_group_id' },
							//{ data: 'contact_phone', name: 'contact_phone' }
						]
					});
				</script>
				@endpush                
                
                
                
                
                
                
            </div>
        </div>
    </div>
	<script>
	var editor; // use a global for the submit and return data rendering in the examples
	 
	$(document).ready(function() {
		editor = new $.fn.dataTable.Editor( {
			ajax: "../php/staff.php",
			table: "#example",
			fields: [ {
					label: "Id:",
					name: "id"
				}, {
					label: "Name:",
					name: "value"
				}, {
					label: "Group Name:",
					name: "name"
				}, {
					label: "Group Id:",
					name: "option_group_id"
				}
			]
		} );
	 
		// Activate an inline edit on click of a table cell
		$('#example').on( 'click', 'tbody td:not(:first-child)', function (e) {
			editor.inline( this );
		} );
	 
		$('#example').DataTable( {
			dom: "Bfrtip",
			ajax: "../php/staff.php",
			order: [[ 1, 'asc' ]],
			columns: [
				{
					data: null,
					defaultContent: '',
					className: 'select-checkbox',
					orderable: false
				},
				{ data: "id" },
				{ data: "value" },
				{ data: "name" },
				{ data: "option_group_id" },
				//{ data: "start_date" },
				//{ data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
			],
			select: {
				style:    'os',
				selector: 'td:first-child'
			},
			buttons: [
				{ extend: "create", editor: editor },
				{ extend: "edit",   editor: editor },
				{ extend: "remove", editor: editor }
			]
		} );
	} );
	
	
	
	$(document).ready(function() {
    $('#example').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
	</script>
</div>
@stop
