<!-- resources/views/common/success.blade.php -->

@if(Session::has('alert-success'))
    <div class="alert alert-success">
        {{ Session::get('alert-success') }}&nbsp;<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
@endif
