@extends('layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('add_new_button')<a href="{{ URL::to('admin/role/create') }}" class="btn btn-default">Add new</a>@endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">Edit {{$title}}</div>
            <div class="pull-right">
                <a href="{{ URL::to('admin/role') }}" class="btn btn-default btn-xs"><span class="fa  fa-arrow-circle-o-left"></span> Back</a>
            </div>
        </div>
        <div class="panel-body">
            {{ Form::open(['route' => ['admin.role.update', $role->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            @if (AdminHelper::isSuperAdmin())
            <div class="form-group required">
                {{ Form::label('client', 'Client:', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-6">
                    {{ Form::select('client', $clients, $role->app_id, ['class' => 'form-control']) }}
                </div>
            </div>
            @else
            {{ Form::hidden('client', Auth::user()->app_id, ['id' => 'client', 'class' => 'form-control', 'placeholder' => 'App id']) }}
            @endif
            <div class="form-group required">
                {{ Form::label('role_name', 'Role Name:', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-6">
                    {{ Form::text('role_name', $role->role_name, ['id' => 'role_name', 'class' => 'form-control', 'placeholder' => 'Role name']) }}
                </div>
            </div>
            <div class="form-group required">
                {{ Form::label('role_name', 'Role Privileges:', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-6">
                    <ul class="privilage-list">
                        @foreach ($privileges as $privilege)
                        <li>
                            {{ Form::checkbox('role_privilage[]', $privilege->id, in_array($privilege->id, $rolePrivileges), ['id' => 'role_privilage'.$privilege->id, 'class' => 'checkbox-inline']) }}
                            {{ Form::label('role_privilage'.$privilege->id, $privilege->privilege_name) }}<br>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="form-group required">
                {{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-6">
                    {{ Form::select('status', ['' => 'Select', '1' => 'Active','0' => 'Inactive'], $role->status, ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('', '', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-6">
                    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
                    <a href="{{ URL::to('admin/role') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@stop