@extends('layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">{{$title}} List</div>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                @if(AdminHelper::checkPermission('privilege_add'))
                <a href="{{ URL::to('admin/privilege/create') }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Add new</a>
                @endif
            </div>
        </div>
        <div class="panel-body">   
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control input-100" placeholder="#" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Privilege Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Privilege Slug" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Description" disabled></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($privileges as $key => $privilege)
                        <tr>
                            <td>{{$privilege->id}}</td>
                            <td>{{$privilege->privilege_name}}</td>
                            <td>{{$privilege->privilege_slug}}</td>
                            <td>{{$privilege->privilege_desc}}</td>
                            
                            <td>
                                <span class="btn-group new-listing">
                                    @if(AdminHelper::checkPermission('privilege_edit'))
                                    <a href="{{ route('admin.privilege.edit', $privilege->id) }}" class="xcrud-action btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    @endif
                                    @if(AdminHelper::checkPermission('privilege_delete'))
                                    {{ Form::open(array('route' => array('admin.privilege.destroy', $privilege->id), 'method' => 'DELETE')) }}
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