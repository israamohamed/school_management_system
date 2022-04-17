@if ($message = Session::get('success'))
    
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="mdi mdi-block-helper me-2"></i>
    {{$message}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


@if ($message = Session::get('warning'))
    
@endif

@if ($message = Session::get('info'))
   
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="mdi mdi-block-helper me-2"></i>
    {{$errors->first()}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
