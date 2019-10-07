@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger alerts">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible alerts">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible alerts">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error!</strong> {{session('error')}}
    </div>
@endif