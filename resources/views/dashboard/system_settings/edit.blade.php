@extends('dashboard.master')

@section('title' , __('general.system_settings.edit'))

@push('styles')

    <style>
         /* Preview */
        .preview {
            width: 60%;
            height: 250px;
            border: 1px solid black;
            margin: auto;
        }
    </style>
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.system_settings.edit')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.system_settings.edit')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.system_settings.edit')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('dashboard.system_setting.update')}}" method = "post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <div class="col-md-12">
                                {{-- create_student_invoices_automatically  --}}
                                <div class="form-group">
                                    <button type="button" class="btn btn-info rounded" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{__('info.create_student_invoices_automatically')}}">
                                        <i class = " fas fa-info-circle" style = "font-size: 1.5em;"></i>
                                    </button>

                                    <label for="create_student_invoices_automatically">{{__('general.system_settings.create_student_invoices_automatically')}}</label>
                                    <input type="checkbox" id = "create_student_invoices_automatically" name = "create_student_invoices_automatically" class = "form-check-input @error('create_student_invoices_automatically') is-invalid @enderror" {{$system_settings && $system_settings->create_student_invoices_automatically ? 'checked' : ''}}>
                                    
                                    @error('create_student_invoices_automatically')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror

                                </div>        
                            </div>
                          
                        </div>

                  
                        <button type="submit" class="btn btn-info btn-lg waves-effect waves-light float-end">
                            <i class="ri-check-line align-middle me-2"></i>
                            {{__('general.edit')}}
                        </button>



                    </form>
                    
                </div>
             

            </div>
        </div>
    </div>
</div>

@endsection

@include('dashboard.scripts.change_educatioanl_data')

@push('scripts')

    <!-- Plugins js -->
    <script src="{{asset('dashboard/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/node-waves/waves.min.js')}}"></script>

    <script src="{{asset('dashboard/assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    

    
    <script>
         $(document).ready(function() {

            $('.preview').click(function() {
                $('#logo').trigger('click')
            });
            $('#logo').change(function(event) {
            
                var image = document.getElementById('logo');
                image.src = URL.createObjectURL(event.target.files[0]);
                $('#cat-img').attr('src', image.src);
                $('#cat-img').css('display', 'block');
            });

            $(".select2").select2({
                theme : 'classic'
            });
    });

        
    </script>

@endpush