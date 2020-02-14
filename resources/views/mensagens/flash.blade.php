@if ($message = Session::get('success'))
    <div class="text-center alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ $message }}
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="text-center alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ $message }}
    </div>
@endif

@if($message = Session::get('warning'))
    <div class="text-center alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ $message }}
    </div>
@endif