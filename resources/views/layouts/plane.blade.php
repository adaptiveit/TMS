@extends('layouts.master')

@section('body')
<div id="wrapper">
    @include('layouts.navigation')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                @include('layouts.success')
                @include('layouts.errors')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@yield('page_heading')</h1>
            </div>
        </div>
        
        <div class="row">  
            @yield('content')
        </div>
    </div>
</div>
@stop
