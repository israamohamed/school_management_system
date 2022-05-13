@extends('dashboard.master')

@section('title' , __('general.school_data.edit'))

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
    <h4 class="mb-sm-0">{{__('general.school_data.edit')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.school_data.edit')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.school_data.edit')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('dashboard.school_data.update')}}" method = "post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row mb-3  justify-content-md-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="logo">{{__('general.school_data.logo')}}</label>
                                    <input type="file" name = "logo" class = "form-control @error('logo') is-invalid @enderror" id = "logo">
                                    @error('logo')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>  
                            </div>
                                
                                
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class='preview' id="preview">
                                            <img  src="{{$school_data ? $school_data->logo : asset('images/logo.png') }}" id="cat-img" width="100%" height="100%">
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--name ar --}}
                                <div class="form-group">
                                    <label for="name_ar">{{__('general.school_data.name_ar')}}</label>
                                    <input type="text" name = "name_ar" class = "form-control @error('name_ar') is-invalid @enderror" value = "{{$school_data ? $school_data->getTranslation('name' , 'ar') : ''}}" placeholder="{{__('general.school_data.name_ar')}}">
                                    @error('name_ar')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- name en --}}
                                <div class="form-group">
                                    <label for="name_en">{{__('general.school_data.name_en')}}</label>
                                    <input type="text" name = "name_en" class = "form-control @error('name_en') is-invalid @enderror" value = "{{$school_data ? $school_data->getTranslation('name' , 'en') : ''}}" placeholder="{{__('general.school_data.name_en')}}">
                                    @error('name_en')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--phone number 1 --}}
                                <div class="form-group">
                                    <label for="phone_number1">{{__('general.school_data.phone_number1')}}</label>
                                    <input type="text" name = "phone_number1" class = "form-control @error('phone_number1') is-invalid @enderror" value = "{{$school_data ? $school_data->phone_number1 : ''}}" placeholder="{{__('general.school_data.phone_number1')}}">
                                    @error('phone_number1')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- phone number 2 --}}
                                <div class="form-group">
                                    <label for="phone_number2">{{__('general.school_data.phone_number2')}}</label>
                                    <input type="text" name = "phone_number2" class = "form-control @error('phone_number2') is-invalid @enderror" value = "{{$school_data ? $school_data->phone_number2 : ''}}" placeholder="{{__('general.school_data.phone_number2')}}">
                                    @error('phone_number2')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--address ar --}}
                                <div class="form-group">
                                    <label for="address_ar">{{__('general.school_data.address_ar')}}</label>
                                    <textarea type="text" name = "address_ar" class = "form-control @error('address_ar') is-invalid @enderror" placeholder="{{__('general.school_data.address_ar')}}">{{$school_data ? $school_data->getTranslation('name' , 'ar') : ''}}</textarea>
                                    @error('address_ar')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- address en --}}
                                <div class="form-group">
                                    <label for="address_en">{{__('general.school_data.address_en')}}</label>
                                    <textarea type="text" name = "address_en" class = "form-control @error('address_en') is-invalid @enderror" placeholder="{{__('general.school_data.address_en')}}">{{$school_data ? $school_data->getTranslation('name' , 'en') : ''}}</textarea>
                                    @error('address_en')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--email  --}}
                                <div class="form-group">
                                    <label for="email">{{__('general.school_data.email')}}</label>
                                    <input type="email" name = "email" class = "form-control @error('email') is-invalid @enderror" value = "{{$school_data ? $school_data->email : ''}}" placeholder="{{__('general.school_data.email')}}">
                                    @error('email')
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