@extends('layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('content')
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
        </div>
    </div>

</div>
@stop







