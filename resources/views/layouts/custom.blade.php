

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8"/>
        <title>Admin | @yield('page_heading')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        
        <meta name="_token" content="{!! csrf_token() !!}"/>

        <link rel="stylesheet" href="{{ asset("backend/stylesheets/bootstrap.min.css") }}" />
        <link rel="stylesheet" href="{{ asset("backend/stylesheets/font-awesome.css") }}" />
        <link rel="stylesheet" href="{{ asset("backend/stylesheets/dataTables.bootstrap.css") }}" />
        
        
        <link rel="stylesheet" href="{{ asset("backend/stylesheets/backend.css") }}" />
       
	
        <script src="{{ asset("backend/scripts/jquery.js") }}" type="text/javascript"></script>
        @yield('styles')
    </head>
    <body>
        @yield('body')
        <script src="{{ asset("backend/scripts/bootstrap.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset("backend/scripts/jquery.metisMenu.js") }}" type="text/javascript"></script>
        <script src="{{ asset("backend/scripts/jquery.dataTables.js") }}" type="text/javascript"></script>
        <script src="{{ asset("backend/scripts/dataTables.fixedHeader.js") }}" type="text/javascript"></script>
        <script src="{{ asset("backend/scripts/dataTables.bootstrap.js") }}" type="text/javascript"></script>
        
        <script src="{{ asset("backend/scripts/backend.js") }}" type="text/javascript"></script>
        <script type="text/javascript">
            $.ajaxSetup({
               headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
            });
        </script>
        @yield('scripts')
    </body>
</html>

