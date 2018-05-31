@extends('layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">{{$title}} List</div>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                @if(AdminHelper::checkPermission('role_add'))
                <a href="{{ URL::to('admin/role/create') }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Add new</a>
                @endif
            </div>
        </div>
        <div class="panel-body">   
            <div class="table-responsive">

                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="#" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Role Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Active" disabled></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->role_name}}</td>
                            <td>
                                @if($role->status == 1)
                                Yes
                                @else
                                No
                                @endif
                            </td>
                            <td>
                                <span class="btn-group">
                                    @if(AdminHelper::checkPermission('role_edit'))
                                    <a href="{{ route('role.edit', $role->id) }}" class="xcrud-action btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    @endif
                                    @if(AdminHelper::checkPermission('role_delete'))
                                    {{ Form::open(array('route' => array('role.destroy', $role->id), 'method' => 'DELETE')) }}
                                    <button type="submit" class="xcrud-action btn btn-danger btn-sm" title="Remove"><i class="fa fa-trash-o"></i></button>
                                    {{ Form::close() }}
                                    @endif
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
