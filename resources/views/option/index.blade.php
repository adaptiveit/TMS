@extends('layouts.plane')
@section('page_heading')  @endsection
@section('content')

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
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="filters">
							<th><input type="text" class="form-control" placeholder="id" disabled></th>
                            <th><input type="text" class="form-control" placeholder="option_group_id" disabled></th>
                             <th><input type="text" class="form-control" placeholder="value" disabled></th>
                             <th><input type="text" class="form-control" placeholder="status" disabled></th>
                              
                            <th>Action</th>
                        </tr>
                    </thead>
                  
                    <tbody>
                        @foreach($fleets as $key => $fleet)
                      
                        <tr>
							 <td>{{ $fleet->id }}</td>
                            <td>{{ $fleet->option_group_id }}</td>
                             <td>{{ $fleet->value }}</td>
                             
                           
                            
                           <td>@if($fleet->status == 1)Yes @else No @endif</td>
                            <td>
                                <span class="btn-group">
                                    @if(AdminHelper::checkPermission('user_edit'))
                                    <a href="{{ route('option.edit', $fleet->id) }}" class="xcrud-action btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    @endif
                                    @if(AdminHelper::checkPermission('user_delete'))
                                    {{ Form::open(array('route' => array('option.destroy', $fleet->id), 'method' => 'DELETE')) }}
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
