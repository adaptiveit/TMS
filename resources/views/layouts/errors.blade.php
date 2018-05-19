@if (count($errors) > 0)
<!-- Form Error List -->
<div class="alert alert-danger">
    <strong>Whoops! Something went wrong!</strong>
    &nbsp;<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
