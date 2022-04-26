@extends('dashboard.master')

@section('title' , __('students.create'))

@push('styles')

    <!-- Lightbox css -->
    <link href="{{asset('dashboard/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />

    <style>
         /* Preview */
        .preview {
            width: 60%;
            height: 250px;
            border: 1px solid rgb(136, 131, 131);
            margin: auto;
        }
    </style>
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('students.show')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.student.index')}}">{{__('students.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('students.show')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4>{{$student->name }}</h4>                 
                </div>


                 <!-- Nav tabs -->
                 <ul class="nav nav-pills nav-justified" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" href="#student_date" role="tab">
                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-block">{{__('students.show')}}</span> 
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#student_parent_date" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-block">{{__('student_parents.show')}}</span> 
                        </a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#attachments" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">{{__('students.attachments')}}</span>   
                        </a>
                    </li>       
                </ul>


                  <!-- Tab panes -->
                  <div class="tab-content p-3 text-muted">
                      @include('dashboard.students.tabs.student_tab')
                      @include('dashboard.students.tabs.student_parent_tab')
                      @include('dashboard.students.tabs.attachments_tab')
                  </div>
                   
                   


                    
            </div>
             

        </div>
    </div>
</div>


@endsection


@push('scripts')

    <!-- Plugins js -->
    <script src="{{asset('dashboard/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/node-waves/waves.min.js')}}"></script>

    <script src="{{asset('dashboard/assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    
    <!-- Magnific Popup-->
    <script src="{{asset('dashboard/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- lightbox init js-->
    <script src="{{asset('dashboard/assets/js/pages/lightbox.init.js')}}"></script>

    
    <script>
         $(document).ready(function() {

            $('.preview').click(function() {
                $('#profile_picture').trigger('click')
            });
            $('#profile_picture').change(function(event) {
                var image = document.getElementById('profile_picture');
                image.src = URL.createObjectURL(event.target.files[0]);
                $('#cat-img').attr('src', image.src);
                $('#cat-img').css('display', 'block');
            });

            $(".select2").select2();
    });

        
    </script>

@endpush