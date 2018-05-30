@extends('layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">{{$title}} List</div>
            <div class="pull-right">
                <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                @if(AdminHelper::checkPermission('user_add'))
                <a href="{{ URL::to('admin/user/create') }}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Add new</a>
                @endif
                
            </div>
        </div>
        <div class="panel-body">   
            <div class="table-responsive">
                <table id="data-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control input-50" placeholder="#" disabled></th>
                            <th><input type="text" class="form-control input-100" placeholder="Username" disabled></th>
                            <th><input type="text" class="form-control input-100" placeholder="Name" disabled></th>
                            <th><input type="text" class="form-control input-150" placeholder="Email" disabled></th>
                            <th><input type="text" class="form-control input-100" placeholder="Role" disabled></th>
							<th><input type="text" class="form-control input-100" placeholder="Active" disabled></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                        {{--*/ $role_name = Modules\Admin\Models\Role::find($user->role_id)->role_name /*--}}
						{{--*/ $role_name = App\Models\Role::find($user->role_id)->role_name /*--}}
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->user_name}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role->role_name}}</td>
							<td>@if($user->status == 1)Yes @else No @endif</td>
                            <td>
                                <span class="btn-group">
                                    @if(AdminHelper::checkPermission('user_edit'))
                                    <a href="{{ route('user.edit', $user->id) }}" class="xcrud-action btn btn-warning btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                    @endif
                                    @if(AdminHelper::checkPermission('user_delete'))
                                    {{ Form::open(array('route' => array('user.destroy', $user->id), 'method' => 'DELETE')) }}
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