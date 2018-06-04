
<html>
  <!DOCTYPE html>

<head>
    <title>Laravel Dependent Dropdown Example with demo</title>
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

</head>
<body>
	

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Orders</a></li>
        <li><a href="#tabs-2">Employees</a></li>
        <li><a href="?gn=products">Products</a></li>
        <li><a href="?gn=customers">Customers</a></li>
        <li><a href="?gn=suppliers">Suppliers</a></li>
    </ul>

    <div id="tabs-1" style="padding:0">
		{{ $title }}
		

    </div>
    
    
    
    
    <div id="tabs-2" style="padding:0">
		{{ $title }}
        PLACEHOLDER - PHPGRID GOES HEREvvvv

    </div>
    
  
    
</div>


<script type="text/javascript">
    $(document).ready(function() {
      
    $( "#tabs" ).tabs({
        beforeLoad: function(event, ui) {
            if(ui.panel.html() == ""){
                ui.panel.html('<div class="loading">Loading...</div>');
                return true;
            } else {
                return false;
            }
        }
    });
  } );
       
  
</script>






