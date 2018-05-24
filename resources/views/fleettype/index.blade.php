@extends('layouts.plane')
@section('page_heading') gg @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">test List</div>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                @if(AdminHelper::checkPermission('fleet_add'))
                <a href="{{ URL::to('admin/fleet/create') }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Add new</a>
                @endif
            </div>
        </div>
        <div class="panel-body">   
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="#" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Fleet" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Reg No" disabled></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($fleets as $key => $fleet)
                        <tr>
                            <td>{{$fleet->fleet_id}}</td>
                            <td>{{$fleet->fleet}}</td>
                            <td>{{$fleet->reg_no}}</td>
                            
                            <td>
                                <span class="btn-group" nowrap>
                                    @if(AdminHelper::checkPermission('fleet_edit'))
                                    <a href="{{ route('fleet.edit', $fleet->fleet_id) }}" class="xcrud-action btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    @endif
                                    @if(AdminHelper::checkPermission('fleet_delete'))
                                    {{ Form::open(array('route' => array('fleet.destroy', $fleet->fleet_id), 'method' => 'DELETE')) }}
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
