@extends('layouts.plane')
@section('page_heading') {{$title}} @endsection
@section('content')

<div class="col-lg-12">
    <div class="panel panel-default filterable">
        <div class="panel-heading">
            <div class="panel-title">Add new {{$title}}</div>
            
        </div>
        <div class="panel-body">
            {{ Form::open(['route' => ['demo.store'], 'method' => 'POST', 'class' => 'form-horizontal']) }}
            {{ csrf_field() }}
         
             
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group required">
                        {{ Form::label('supplier_name', 'Name:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('supplier_name', old('supplier_name'), ['id' => 'supplier_name', 'class' => 'form-control', 'placeholder' => 'Name']) }}
                        </div>
                    </div>
                    <div class="form-group ">
                        {{ Form::label('address', 'Address:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('address', old('address'), ['id' => 'address', 'class' => 'form-control', 'placeholder' => 'Address']) }}
                        </div>
                    </div>
                    <div class="form-group required">
                        {{ Form::label('contact_person', 'Contact Person:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('contact_person', old('contact_person'), ['id' => 'contact_person', 'class' => 'form-control', 'placeholder' => 'Contact Person']) }}
                        </div>
                    </div>
 
                    <div class="form-group required">
                        {{ Form::label('telephone', 'Contact Number:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('telephone', old('telephone'), ['id' => 'telephone', 'class' => 'form-control', 'placeholder' => 'Contact Number']) }}
                        </div>
                    </div>
 
                    <div class="form-group required">
                        {{ Form::label('remarks', 'Remarks:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::text('remarks', old('remarks'), ['id' => 'remarks', 'class' => 'form-control', 'placeholder' => 'Remarks']) }}
                        </div>
                    </div>

					 <div class="form-group required">
                        {{ Form::label('status', 'Status:', array('class' => 'control-label col-sm-3')) }}
                        <div class="col-sm-8">
                            {{ Form::select('status', ['1' => 'Active','0' => 'Inactive'], old('status'), ['placeholder' => '- Select -', 'class' => 'form-control']) }}
                        </div>
                    </div>
  
                </div>
                      
            </div>
            <div class="form-group">
                {{ Form::label('', '', array('class' => 'control-label col-sm-3')) }}
                <div class="col-sm-6">
                    {{ Form::submit('Submit', ['class' => 'btn btn-default']) }}
                    <a href="{{ URL::to('admin/demo') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop

