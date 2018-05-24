@extends('layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">Edit {{$title}}</div>
            <div class="pull-right">
                <a href="{{ URL::to('admin/user') }}" class="btn btn-default btn-xs"><span class="fa  fa-arrow-circle-o-left"></span> Back</a>
            </div>
        </div>
        <div class="panel-body">
            {{ Form::open(['route' => ['admin.user.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                    @if (AdminHelper::isSuperAdmin())
                    <div class="form-group required">
                        {{ Form::label('client', 'Client:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::select('client', $clients, $user->app_id, ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    @else
                        {{ Form::hidden('client', Auth::user()->app_id, ['id' => 'client', 'class' => 'form-control', 'placeholder' => 'App id']) }}
                    @endif
                    <div class="form-group required">
                        {{ Form::label('role', 'Role:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::select('role', $roles, $user->role_id, ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('user_name', 'Username:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('user_name', $user->user_name, ['id' => 'user_name', 'class' => 'form-control', 'placeholder' => 'Username']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('email', 'Email:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::email('email', $user->email, ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email']) }}
                        </div>
                    </div> 
                    <div class="form-group">
                        {{ Form::label('password', 'Password:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('phone', 'Phone:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('phone', $user->phone, ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Phone']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('first_name', 'First Name:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('first_name', $user->first_name, ['id' => 'user_name', 'class' => 'form-control', 'placeholder' => 'First name']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('last_name', 'Last Name:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('last_name', $user->last_name, ['id' => 'user_name', 'class' => 'form-control', 'placeholder' => 'Last name']) }}
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('address', 'Address:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::textarea('address', $user->address, ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address', 'rows' => '5']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('state', 'State:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::select('state', $states, $user->state_id, ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('city', 'City:', array('class' => 'control-label col-sm-3')) }}
                        <input type="hidden" value="{{$user->city_id}}" name="checked_city" id="checked_city">
                        <div class="col-sm-8">
                            @if(isset($cities))
                            <div class="check-all"><input type="checkbox" name="check_all" id="check_all">&nbsp;Check All</div>
                            <ul class="city-list" id="city-list">
                                @foreach ($cities as $city)
                                <li>
                                    {{ Form::checkbox('city[]', $city->id, null, ['id' => 'city'.$city->id, 'class' => 'checkbox-inline']) }}
                                    {{ Form::label('city'.$city->id, $city->city_name) }}
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::select('status', ['1' => 'Active','0' => 'Inactive'], $user->status, ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('', '', array('class' => 'control-label col-sm-2')) }}
                <div class="col-sm-6">
                    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
                    <a href="{{ URL::to('admin/user') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@stop