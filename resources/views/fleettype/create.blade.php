@extends('layouts.plane')
@section('page_heading')  @endsection
@section('content')

{!! Form::open(['route' => 'fleettype.store','class' => 'form']) !!}
<div class="col wrapper">
<div class="form-group">
    {!! Form::label('fleet_type', '	fleet_type') !!}
    {!! Form::text('fleet_type', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('incharge_id', 'incharge_id') !!}
    {!! Form::text('incharge_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('staus', 'status') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

{!! Form::submit('Submit', ['class' => 'btn btn-info']) !!}

{!! Form::close() !!}

</div>

<style>
	.wrapper{
		    width: 50%;
    margin-left: 30%;
	}


</style>
