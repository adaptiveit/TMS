@extends('layouts.customplane')
@section('page_heading') {{$title}} @endsection
@section('content')
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="{{ asset("backend/stylesheets/token-input.css") }}" />
        <link rel="stylesheet" href="{{ asset("backend/stylesheets/token-input-facebook.css") }}" />

        <script src="{{ asset("backend/scripts/jquery.tokeninput.js") }}" type="text/javascript"></script>
<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">{{$title}} List</div>
			<div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                <!--@if(AdminHelper::checkPermission('user_add'))-->
                <a href="{{ URL::to('admin/demo/create') }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Add new</a>
                <!--@endif-->
                
            </div>
        </div>
        <div class="panel-body">   
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                         <tr class="filters">
                            <th><input type="text" class="form-control form-control input-50" placeholder="#" disabled></th>
                            <th><input type="text" class="form-control form-control input-100" placeholder="Name" disabled></th>
                            <th><input type="text" class="form-control form-control input-100" placeholder="Address" disabled></th>
                            <th><input type="text" class="form-control form-control input-100" placeholder="Contact Person" disabled></th>
                            <th><input type="text" class="form-control form-control input-100" placeholder="Contact Number" disabled></th>
                            <th><input type="text" class="form-control form-control input-100" placeholder="Remark" disabled></th>
                            <!--<th><input type="text" class="form-control" placeholder="Status" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Created By" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Updated By" disabled></th>-->
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($demos as $key => $demo)
                        <tr>
                            <td>{{$demo->id}}</td>
                            <td>{{$demo->supplier_name}}</td>
                            <td>{{$demo->address}}</td>
                            <td>{{$demo->contact_person}}</td>
                            <td>{{$demo->telephone}}</td>
                            <td>{{$demo->remarks}}</td>
                           <!-- <td>{{$demo->status}}</td>
                            <td>{{$demo->created_by}}</td>
                            <td>{{$demo->updated_by}}</td>-->
                            
                            <td>
                                <span class="btn-group" nowrap>
                                   <!-- @if(AdminHelper::checkPermission('fuelstation_edit'))-->
                                    <a href="{{ route('demo.edit', $demo->id) }}" class="xcrud-action btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                   <!-- @endif
                                    @if(AdminHelper::checkPermission('fuelstation_delete'))-->
                                    {{ Form::open(array('route' => array('demo.destroy', $demo->id), 'method' => 'DELETE')) }}
                                    <button type="submit" class="xcrud-action btn btn-danger btn-sm" title="Remove"><i class="fa fa-trash-o"></i></button>
                                    {{ Form::close() }}
                                    <!-- @endif -->
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            
            <div class="table-responsive">
                
			 <h2>Simple Local Data Search</h2>
				<div>
					<input type="text" id="demo-input-local" name="blah" />
					<input type="button" value="Submit" />
					<script type="text/javascript">
					$(document).ready(function() {
						$("#demo-input-local").tokenInput([
							{id: 7, name: "Ruby"},
							{id: 11, name: "Python"},
							{id: 13, name: "JavaScript"},
							{id: 17, name: "ActionScript"},
							{id: 19, name: "Scheme"},
							{id: 23, name: "Lisp"},
							{id: 29, name: "C#"},
							{id: 31, name: "Fortran"},
							{id: 37, name: "Visual Basic"},
							{id: 41, name: "C"},
							{id: 43, name: "C++"},
							{id: 47, name: "Java"}
						]);
					});
					</script>
				</div>


				<h2 id="theme">Facebook Theme</h2>
				<div>
					<input type="text" id="demo-input-facebook-theme" name="blah2" />
					<input type="button" value="Submit" />
					<script type="text/javascript">
					$(document).ready(function() {
						$("#demo-input-facebook-theme").tokenInput("/autocomplete", {
							theme: "facebook"
						});
					});
					</script>
				</div>


				<h2 id="custom-labels">Custom Labels</h2>
				<div>
					<input type="text" id="demo-input-custom-labels" name="blah" />
					<input type="button" value="Submit" />
					<script type="text/javascript">
					$(document).ready(function() {
						$("#demo-input-custom-labels").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
							hintText: "I can has tv shows?",
							noResultsText: "O noes",
							searchingText: "Meowing..."
						});
					});
					</script>
				</div>


				<h2 id="custom-delete">Custom Delete Icon</h2>
				<div>
					<input type="text" id="demo-input-custom-delete" name="blah" />
					<input type="button" value="Submit" />
					<script type="text/javascript">
					$(document).ready(function() {
						$("#demo-input-custom-delete").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
							deleteText: "&#x2603;"
						});
					});
					</script>
				</div>


				<h2 id="custom-limits">Custom Search Delay, Search Limit &amp; Token Limit</h2>
				<div>
					<input type="text" id="demo-input-custom-limits" name="blah" />
					<input type="button" value="Submit" />
					<script type="text/javascript">
					$(document).ready(function() {
						$("#demo-input-custom-limits").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
							searchDelay: 2000,
							minChars: 4,
							tokenLimit: 3
						});
					});
					</script>
				</div>


				<h2 id="prevent-custom-delimiter">Custom Token Delimiter</h2>
				<div>
					<input type="text" id="demo-input-custom-delimiter" name="blah" />
					<input type="button" value="Submit" />
					<script type="text/javascript">
					$(document).ready(function() {
						$("#demo-input-custom-delimiter").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
							tokenDelimiter: "|"
						});
					});
					</script>
				</div>


				<h2 id="prevent-duplicates">No Duplicates</h2>
				<div>
					<input type="text" id="demo-input-prevent-duplicates" name="blah" />
					<input type="button" value="Submit" />
					<script type="text/javascript">
					$(document).ready(function() {
						$("#demo-input-prevent-duplicates").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
							preventDuplicates: true
						});
					});
					</script>
				</div>


				<h2 id="pre-populated">Pre-populated</h2>
				<div>
					<input type="text" id="demo-input-pre-populated" name="blah" />
					<input type="button" value="Submit" />
					<script type="text/javascript">
					$(document).ready(function() {
						$("#demo-input-pre-populated").tokenInput("http://shell.loopj.com/tokeninput/tvshows.php", {
							prePopulate: [
								{id: 123, name: "Slurms MacKenzie"},
								{id: 555, name: "Bob Hoskins"},
								{id: 9000, name: "Kriss Akabusi"}
							]
						});
					});
					</script>
				</div>
						
						
                
			</div>
 
            
        </div>
    </div>

</div>
<script type="text/javascript">
	$(document).ready(function() {
		$("input[type=button]").click(function () {
			alert("Would submit: " + $(this).siblings("input[type=text]").val());
		});
	});
</script>
@stop







