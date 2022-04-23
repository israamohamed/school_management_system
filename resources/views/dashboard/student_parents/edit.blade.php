@extends('dashboard.master')

@section('title' , __('student_parents.edit'))

@push('styles')
    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="{{asset('dashboard/assets/libs/twitter-bootstrap-wizard/prettify.css')}}">
    <!-- Plugins css -->
    <link href="{{asset('dashboard/assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('student_parents.edit')}} : {{$student_parent->father_name}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.student_parent.index')}}">{{__('student_parents.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('student_parents.edit')}}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('student_parents.edit')}} : {{$student_parent->father_name}}</h4>
                    
                    @livewire('add-parent', ['student_parent' => $student_parent])
                </div>
             

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

    <!-- form wizard -->
    <script src="{{asset('dashboard/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/twitter-bootstrap-wizard/prettify.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/form-wizard.init.js')}}"></script>
    <!-- Plugins js -->
    <script src="{{asset('dashboard/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    

    <script>
        $(".select2").select2();
    </script>

@endpush