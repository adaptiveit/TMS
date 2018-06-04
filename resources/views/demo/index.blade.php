<!DOCTYPE html>
<html>
<head>
    <title>Laravel Dependent Dropdown Example with demo</title>
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/bootstrap-3.min.css">
     <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

</head>
<body>
	
	
<script type="text/javascript">
      $('#searchname').autocomplete({
        source:'/index.php/admin/ajax',
          minlength:1,
          autoFocus:true,
          select:function(e,ui)
          {
              $('#searchname').val(ui.item.value);
          }
      });
</script>

<input type="text" class="form-control" placeholder="TagName" id="searchname" name="TagName">

<div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">Select State and get bellow Related City</div>
      <div class="panel-body">
            <div class="form-group">
                <label for="title">Select Group Name:</label>
                 <select name="state" class="form-control" style="width:350px">
                    <option value="">--- Select Group Name ---</option>
                    @foreach ($fleets as $key => $value)
                        <option value="{{ $key }}">{{ $value}}</option>
                    @endforeach
                </select>
                
            </div>
            <div class="form-group">
                <label for="title">Select Option value:</label>
                <select name="city" class="form-control" style="width:350px">
                </select>
            </div>
      </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="state"]').on('change', function() {
            var stateID = $(this).val();
            var pathname = window.location.pathname;
            var url      = window.location.href; 
           // alert(pathname);
            if(stateID) {
                $.ajax({
                    url: '/index.php/admin/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
						//alert(data);
                        console.log(data);
                        $('select[name="city"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });


                    }
                });
            }else{
                $('select[name="city"]').empty();
            }
        });
    });
</script>





