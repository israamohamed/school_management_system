@extends('students.master')

@section('title' , __('online_classes.title'))

@push('styles')

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('online_classes.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('student.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('online_classes.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

{{-- Filters --}}
{{-- <div style = "margin: 10px 0;">
    <form method = "GET">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name = "search" class = "form-control" value = "{{request()->search}}" onchange="this.form.submit()" placeholder="{{__('general.search')}}">
            </div>

        </div>
    </form>
</div> --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    {{-- <h4 class = "float-start">{{__('online_classes.title')}} <span class="badge rounded-pill bg-dark">{{$online_classes->total()}}</span> </h4> --}}
                    <div class="clearfix"></div>
                </div>

                     <!-- Nav tabs -->
                     <ul class="nav nav-pills nav-justified" role="tablist">
                        {{-- upcoming_tab --}}
                        <li class="nav-item waves-effect waves-light shadow-lg p-3 mb-2 rounded">
                            <a class="nav-link active" data-bs-toggle="tab" href="#upcoming_tab" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">{{__('online_classes.upcoming_online_classes')}}</span> 
                            </a>
                        </li>
                        {{-- previous_tab --}}
                        <li class="nav-item waves-effect waves-light shadow-lg p-3 mb-2 rounded">
                            <a class="nav-link" data-bs-toggle="tab" href="#previous_tab" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">{{__('online_classes.previous_online_classes')}}</span> 
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                  <div class="tab-content p-3 text-muted">
                    @include('students.online_classes.tabs.upcoming')
                    @include('students.online_classes.tabs.previous')
                    {{-- @include('teacher.quizzes.tabs.quiz_parent_tab') --}}


                </div>

               
               
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
    $(".select2").each(function(ele){
        var placeholder = $(this).attr("placeholder");

        $(this).select2({
            placeholder:  placeholder,
        });
    });

</script>


<script>
    function copy_join_url() {
        /* Get the text field */
        var join_url_text = $(".join_url");

        /* Select the text field */
        join_url_text.select();
        //join_url_text.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(join_url_text.val());

        toastr.success("{{__('general.copy_to_clipboard')}}")
    }
</script>

@endpush