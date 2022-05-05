@extends('dashboard.master')

@section('title' , __('teachers.create'))

@push('styles')
    <!-- Plugins css -->
    <link href="{{asset('dashboard/assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />

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
    <h4 class="mb-sm-0">{{__('teachers.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.teacher.index')}}">{{__('teachers.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('teachers.create')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('teachers.create')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('dashboard.teacher.store')}}" method = "post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3  justify-content-md-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="profile_picture">{{__('teachers.profile_picture')}}</label>
                                    <input type="file" name = "profile_picture" class = "form-control @error('profile_picture') is-invalid @enderror" id = "profile_picture">
                                    @error('profile_picture')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>  
                            </div>
                                
                                
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class='preview' id="preview">
                                            <img  src="{{asset('images/default_user.png')}}" id="cat-img" width="100%" height="100%">
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--name ar --}}
                                <div class="form-group">
                                    <label for="name_ar">{{__('teachers.name_ar')}}</label>
                                    <input type="text" name = "name_ar" class = "form-control @error('name_ar') is-invalid @enderror" value = "{{old('name_ar')}}" placeholder="{{__('teachers.name_ar')}}">
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
                                    <label for="name_en">{{__('teachers.name_en')}}</label>
                                    <input type="text" name = "name_en" class = "form-control @error('name_en') is-invalid @enderror" value = "{{old('name_en')}}" placeholder="{{__('teachers.name_en')}}">
                                    @error('name_en')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <div class="col-md-4">
                                {{--gender --}}
                                <div class="form-group">
                                    <label for="gender">{{__('general.gender')}}</label>
                                    <select name="gender" class = "form-control select2 @error('gender') is-invalid @enderror">
                                        <option value="">{{__('general.select_gender')}}</option>
                                        <option value="male" {{old('gender') == 'male' ? 'selected' : ''}} >{{__('general.male')}}</option>
                                        <option value="female" {{old('gender') == 'female' ? 'selected' : ''}} >{{__('general.female')}}</option>                                      
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-4">
                                {{-- birth date --}}
                                <div class="form-group">
                                    <label for="birth_date">{{__('teachers.birth_date')}}</label>
                                    <input type="date" name = "birth_date" class = "form-control @error('birth_date') is-invalid @enderror" value = "{{old('birth_date')}}" placeholder="{{__('teachers.birth_date')}}">
                                    @error('birth_date')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                {{-- hiring date  --}}
                                    <div class="form-group">
                                        <label for="hiring_date">{{__('teachers.hiring_date')}}</label>
                                        <input type="date" name = "hiring_date" class = "form-control @error('hiring_date') is-invalid @enderror" value = "{{old('hiring_date')}}" placeholder="{{__('teachers.hiring_date')}}">
                                        @error('hiring_date')
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
                                    <label for="phone_number1">{{__('teachers.phone_number1')}}</label>
                                    <input type="text" name = "phone_number1" class = "form-control @error('phone_number1') is-invalid @enderror" value = "{{old('phone_number1')}}" placeholder="{{__('teachers.phone_number1')}}">
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
                                    <label for="phone_number2">{{__('teachers.phone_number2')}}</label>
                                    <input type="text" name = "phone_number2" class = "form-control @error('phone_number2') is-invalid @enderror" value = "{{old('phone_number2')}}" placeholder="{{__('teachers.phone_number2')}}">
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
                                {{--email  --}}
                                <div class="form-group">
                                    <label for="email">{{__('teachers.email')}}</label>
                                    <input type="email" name = "email" class = "form-control @error('email') is-invalid @enderror" value = "{{old('email')}}" placeholder="{{__('teachers.email')}}">
                                    @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- password  --}}
                                <div class="form-group">
                                    <label for="password">{{__('teachers.password')}}</label>
                                    <input type="password" name = "password" class = "form-control @error('password') is-invalid @enderror" placeholder="{{__('teachers.password')}}">
                                    @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="subjects">{{__('general.subjects.title')}}</label>
                                    <select name="subjects[]" class = "form-control select2 @error('subjects') is-invalid @enderror"  multiple="multiple" placeholder = "{{__('teachers.select_teacher_subjects')}}">
                                        <option value="" disabled>{{__('teachers.select_teacher_subjects')}}</option>
                                        @foreach($subjects as $subject )
                                            <option value="{{$subject->id}}" {{old('subjects') &&  in_array($subject->id , old('subjects')) ? 'selected' : '' }}  >{{$subject->name_in_details}}</option>
                                        @endforeach
                                    </select>
                                    @error('subjects')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>    
                            </div>
                        </div>

                    
                        {{-- active --}}
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="active">{{__('general.active')}}</label>
                                    <input type="checkbox" name = "active" class = "form-check-input @error('active') is-invalid @enderror" id = "active" {{old('active') ? 'checked' : ''}} >
                                    @error('active')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light float-end">
                            <i class="ri-check-line align-middle me-2"></i>
                            {{__('general.add')}}
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
                $('#profile_picture').trigger('click')
            });
            $('#profile_picture').change(function(event) {
                var image = document.getElementById('profile_picture');
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