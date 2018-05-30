@extends('layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">Add New {{$title}}</div>
            <div class="pull-right">
                <a href="{{ URL::to('admin/privilege') }}" class="btn btn-default btn-xs"><span class="fa  fa-arrow-circle-o-left"></span> Back</a>
            </div>
        </div>
        <div class="panel-body">
            {{ Form::open(['route' => ['admin.privilege.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
                {{ csrf_field() }}
                <div class="form-group required">
                    {{ Form::label('module_id', 'Module:', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-6">
                        <select name="module_id" class="form-control">  
                            <option value="">Select</option>     
                            <?php \Modules\Admin\Models\Privilege::getModuleSelectList(0, old('module_id')); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group required">
                    {{ Form::label('privilege_name', 'Privilege Name:', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-6">
                        {{ Form::text('privilege_name', old('privilege_name'), ['id' => 'privilege_name', 'class' => 'form-control', 'placeholder' => 'Privilege name']) }}
                    </div>
                </div>
                <div class="form-group required">
                    {{ Form::label('privilege_desc', 'Privilege Description:', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-6">
                        {{ Form::textarea('privilege_desc', old('privilege_desc'), ['id' => 'privilege_desc', 'class' => 'form-control', 'placeholder' => 'Privilege description', 'rows' => '3'] ) }}
                    </div>
                </div>
                <div class="form-group required">
                    {{ Form::label('privilege_slug', 'Privilege Slug:', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-6">
                        {{ Form::text('privilege_slug', old('privilege_slug'), ['id' => 'privilege_slug', 'class' => 'form-control', 'placeholder' => 'Privilege Slug']) }}
                        <i class="hint">Example like: user_add, user_edit, user_delete, user_list</i>
                    </div>
                </div>
                <div class="form-group required">
                    {{ Form::label('url', 'URL:', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-6">
                        {{ Form::text('url', old('url'), ['id' => 'url', 'class' => 'form-control', 'placeholder' => 'URL']) }}
                    </div>
                </div>
                <div class="form-group required">
                    {{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-6">
                        {{ Form::select('status', ['' => 'Select', '1' => 'Active','0' => 'Inactive'], old('status'), ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('', '', array('class' => 'control-label col-sm-2')) }}
                    <div class="col-sm-6">
                        {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
                        <a href="{{ URL::to('admin/privilege') }}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
                {{ Form::close() }}
        </div>
    </div>
</div>


@stop