@extends('dashboard.master')

@section('title' , __('students.title'))

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
    <h4 class="mb-sm-0">{{__('students.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.student.index')}}">{{__('students.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('students.create')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('students.create')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('dashboard.student.store')}}" method = "post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3  justify-content-md-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="profile_picture">{{__('students.profile_picture')}}</label>
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
                                    <label for="name_ar">{{__('students.name_ar')}}</label>
                                    <input type="text" name = "name_ar" class = "form-control @error('name_ar') is-invalid @enderror" value = "{{old('name_ar')}}" placeholder="{{__('students.name_ar')}}">
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
                                    <label for="name_en">{{__('students.name_en')}}</label>
                                    <input type="text" name = "name_en" class = "form-control @error('name_en') is-invalid @enderror" value = "{{old('name_en')}}" placeholder="{{__('students.name_en')}}">
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
                                {{--code --}}
                                <div class="form-group">
                                    <label for="code">{{__('students.code')}}</label>
                                    <input type="text" name = "code" class = "form-control @error('code') is-invalid @enderror" value = "{{old('code')}}" placeholder="{{__('students.code')}}">
                                    @error('code')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- national id --}}
                                <div class="form-group">
                                    <label for="national_id">{{__('students.national_id')}}</label>
                                    <input type="text" name = "national_id" class = "form-control @error('national_id') is-invalid @enderror" value = "{{old('national_id')}}" placeholder="{{__('students.national_id')}}">
                                    @error('national_id')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                {{-- birth date --}}
                                <div class="form-group">
                                    <label for="birth_date">{{__('students.birth_date')}}</label>
                                    <input type="date" name = "birth_date" class = "form-control @error('birth_date') is-invalid @enderror" value = "{{old('birth_date')}}" placeholder="{{__('students.birth_date')}}">
                                    @error('birth_date')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--birth place ar --}}
                                <div class="form-group">
                                    <label for="birth_place_ar">{{__('students.birth_place_ar')}}</label>
                                    <input type="text" name = "birth_place_ar" class = "form-control @error('birth_place_ar') is-invalid @enderror" value = "{{old('birth_place_ar')}}" placeholder="{{__('students.birth_place_ar')}}">
                                    @error('birth_place_ar')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- birth place en --}}
                                <div class="form-group">
                                    <label for="birth_place_en">{{__('students.birth_place_en')}}</label>
                                    <input type="text" name = "birth_place_en" class = "form-control @error('birth_place_en') is-invalid @enderror" value = "{{old('birth_place_en')}}" placeholder="{{__('students.birth_place_en')}}">
                                    @error('birth_place_en')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--phone number  --}}
                                <div class="form-group">
                                    <label for="phone_number1">{{__('students.phone_number1')}}</label>
                                    <input type="text" name = "phone_number1" class = "form-control @error('phone_number1') is-invalid @enderror" value = "{{old('phone_number1')}}" placeholder="{{__('students.phone_number1')}}">
                                    @error('phone_number1')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- phone number  --}}
                                <div class="form-group">
                                    <label for="phone_number2">{{__('students.phone_number2')}}</label>
                                    <input type="text" name = "phone_number2" class = "form-control @error('phone_number2') is-invalid @enderror" value = "{{old('phone_number2')}}" placeholder="{{__('students.phone_number2')}}">
                                    @error('phone_number2')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">

                            <div class="col-md-3">
                                {{--parent  --}}
                                <div class="form-group">
                                    <label for="student_parent_id">{{__('student_parents.one')}}</label>
                                    <select name="student_parent_id" class = "form-control select2 @error('student_parent_id') is-invalid @enderror">
                                        <option value="">{{__('student_parents.select')}}</option>
                                        @foreach($student_parents as $student_parent)
                                            <option value="{{$student_parent->id}}" {{old('student_parent_id') == $student_parent->id ? 'selected' : ''}} >{{$student_parent->father_name}} - {{$student_parent->mother_name}}</option>
                                        @endforeach       
                                    </select>
                                    @error('student_parent_id')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>

                            <div class="col-md-3">
                                {{--blood type  --}}
                                <div class="form-group">
                                    <label for="blood_type_id">{{__('general.blood_types.one')}}</label>
                                    <select name="blood_type_id" class = "form-control select2 @error('blood_type_id') is-invalid @enderror">
                                        <option value="">{{__('general.blood_types.select')}}</option>
                                        @foreach($blood_types as $blood_type)
                                            <option value="{{$blood_type->id}}" {{old('blood_type_id') == $blood_type->id ? 'selected' : ''}} >{{$blood_type->name}}</option>
                                        @endforeach       
                                    </select>
                                    @error('blood_type_id')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>

                            <div class="col-md-3">
                                {{--nationalitiy  --}}
                                <div class="form-group">
                                    <label for="nationality_id">{{__('general.nationalities.one')}}</label>
                                    <select name="nationality_id" class = "form-control select2 @error('nationality_id') is-invalid @enderror">
                                        <option value="">{{__('general.nationalities.select')}}</option>
                                        @foreach($nationalities as $nationality)
                                            <option value="{{$nationality->id}}" {{old('nationality_id') == $nationality->id ? 'selected' : ''}} >{{$nationality->name}}</option>
                                        @endforeach       
                                    </select>
                                    @error('nationality_id')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>

                            <div class="col-md-3">
                                {{--relision  --}}
                                <div class="form-group">
                                    <label for="relision_id">{{__('general.relisions.one')}}</label>
                                    <select name="relision_id" class = "form-control select2 @error('relision_id') is-invalid @enderror">
                                        <option value="">{{__('general.relisions.select')}}</option>
                                        @foreach($relisions as $relision)
                                            <option value="{{$relision->id}}" {{old('relision_id') == $relision->id ? 'selected' : ''}} >{{$relision->name}}</option>
                                        @endforeach       
                                    </select>
                                    @error('relision_id')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                           
                        </div>



                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--address  --}}
                                <div class="form-group">
                                    <label for="address">{{__('students.address')}}</label>
                                    <textarea type="text" name = "address" class = "form-control @error('address') is-invalid @enderror" placeholder="{{__('students.address')}}">{{old('address')}}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>

                            <div class="col-md-6">
                                {{--notes  --}}
                                <div class="form-group">
                                    <label for="notes">{{__('students.notes')}}</label>
                                    <textarea type="text" name = "notes" class = "form-control @error('notes') is-invalid @enderror" placeholder="{{__('students.notes')}}">{{old('notes')}}</textarea>
                                    @error('notes')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            
                        </div>


                        <div class="row mb-3">

                            <div class="col-md-3">
                                {{-- joinging date  --}}
                                    <div class="form-group">
                                        <label for="joining_date">{{__('students.joining_date')}}</label>
                                        <input type="date" name = "joining_date" class = "form-control @error('joining_date') is-invalid @enderror" value = "{{old('joining_date')}}" placeholder="{{__('students.joining_date')}}">
                                        @error('joining_date')
                                        <div class="invalid-feedback d-block">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>      
                            </div>

                            <div class="col-md-3 educational_stage_selected_parent">
                                 {{-- educational stage --}}
                                <div class="form-group"> 
                                    <label for="educational_stage_id">{{__('general.educational_stages.one')}}</label>
                                    <select name="educational_stage_id" class = "form-control educational_stage_selected select2  @error('educational_stage_id') is-invalid @enderror" style = "width: 100%;">
                                        <option value="">{{__('general.educational_stages.one')}}</option>
                                            @foreach($educational_stages as $educational_stage)
                                                <option value="{{$educational_stage->id}}" {{$educational_stage->id == old('educational_stage_id') ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                                            @endforeach
                                    </select>
                                    @error('educational_stage_id')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 class_room_selected_parent">
                                {{-- class room  --}}
                                <div class="form-group">
                                    <label for="class_room_id">{{__('general.class_rooms.one')}}</label>
                                    <select name="class_room_id" class = "form-control class_room_selected select2  @error('class_room_id') is-invalid @enderror">
                                        
                                    </select>
                                    @error('class_room_id')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>                
                            </div>

                            <div class="col-md-3">
                                {{-- educational class room  --}}
                                <div class="form-group">
                                    <label for="educational_class_room_id">{{__('general.educational_class_rooms.one')}}</label>
                                    <select name="educational_class_room_id" class = "form-control educational_class_room_selected select2 @error('educational_class_room_id') is-invalid @enderror">
                                        
                                    </select>
                                    @error('educational_class_room_id')
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
                                    <label for="email">{{__('students.email')}}</label>
                                    <input type="email" name = "email" class = "form-control @error('email') is-invalid @enderror" value = "{{old('email')}}" placeholder="{{__('students.email')}}">
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
                                    <label for="password">{{__('students.password')}}</label>
                                    <input type="password" name = "password" class = "form-control @error('password') is-invalid @enderror" placeholder="{{__('students.password')}}">
                                    @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- attachments --}}
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="attachments">{{__('students.attachments')}}</label>
                                    <input type="file" name = "attachments[]" class = "form-control @error('attachments') is-invalid @enderror" id = "attachments" multiple>
                                    @error('attachments')
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

            $(".select2").select2();
    });

        
    </script>

@endpush