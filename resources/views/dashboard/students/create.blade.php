@extends('dashboard.master')

@section('title' , __('students.title'))

@push('styles')
    <!-- Plugins css -->
    <link href="{{asset('dashboard/assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css" />
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


                    <form action="{{route('dashboard.student.store')}}" method = "post">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--name ar --}}
                                <div class="form-group">
                                    <label for="name_ar">{{__('students.name_ar')}}</label>
                                    <input type="text" name = "name_ar" class = "form-control" value = "{{old('name_ar')}}" placeholder="{{__('students.name_ar')}}">
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- name en --}}
                                <div class="form-group">
                                    <label for="name_en">{{__('students.name_en')}}</label>
                                    <input type="text" name = "name_en" class = "form-control" value = "{{old('name_en')}}" placeholder="{{__('students.name_en')}}">
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--code --}}
                                <div class="form-group">
                                    <label for="code">{{__('students.code')}}</label>
                                    <input type="text" name = "code" class = "form-control" value = "{{old('code')}}" placeholder="{{__('students.code')}}">
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- national id --}}
                                <div class="form-group">
                                    <label for="national_id">{{__('students.national_id')}}</label>
                                    <input type="text" name = "national_id" class = "form-control" value = "{{old('national_id')}}" placeholder="{{__('students.national_id')}}">
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--gender --}}
                                <div class="form-group">
                                    <label for="gender">{{__('general.gender')}}</label>
                                    <select name="gender" class = "form-control select2">
                                        <option value="">{{__('general.select_gender')}}</option>
                                        <option value="male" {{old('gender' == 'male' ? 'selected' : '')}} >{{__('general.male')}}</option>
                                        <option value="female" {{old('gender' == 'female' ? 'selected' : '')}} >{{__('general.female')}}</option>                                      
                                    </select>
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- birth date --}}
                                <div class="form-group">
                                    <label for="birth_date">{{__('students.birth_date')}}</label>
                                    <input type="date" name = "birth_date" class = "form-control" value = "{{old('birth_date')}}" placeholder="{{__('students.birth_date')}}">
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--birth place ar --}}
                                <div class="form-group">
                                    <label for="birth_place_ar">{{__('students.birth_place_ar')}}</label>
                                    <input type="text" name = "birth_place_ar" class = "form-control" value = "{{old('birth_place_ar')}}" placeholder="{{__('students.birth_place_ar')}}">
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- birth place en --}}
                                <div class="form-group">
                                    <label for="birth_place_en">{{__('students.birth_place_en')}}</label>
                                    <input type="text" name = "birth_place_en" class = "form-control" value = "{{old('birth_place_en')}}" placeholder="{{__('students.birth_place_en')}}">
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--phone number  --}}
                                <div class="form-group">
                                    <label for="phone_number1">{{__('students.phone_number1')}}</label>
                                    <input type="text" name = "phone_number1" class = "form-control" value = "{{old('phone_number1')}}" placeholder="{{__('students.phone_number1')}}">
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- phone number  --}}
                                <div class="form-group">
                                    <label for="phone_number2">{{__('students.phone_number2')}}</label>
                                    <input type="text" name = "phone_number2" class = "form-control" value = "{{old('phone_number2')}}" placeholder="{{__('students.phone_number2')}}">
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">

                            <div class="col-md-3">
                                {{--parent  --}}
                                <div class="form-group">
                                    <label for="student_parent_id">{{__('student_parents.one')}}</label>
                                    <select name="student_parent_id" class = "form-control select2">
                                        <option value="">{{__('student_parents.select')}}</option>
                                        @foreach($student_parents as $student_parent)
                                            <option value="{{$student_parent->id}}" {{old('student_parent_id' == $student_parent->id ? 'selected' : '')}} >{{$student_parent->name}}</option>
                                        @endforeach       
                                    </select>
                                </div>        
                            </div>

                            <div class="col-md-3">
                                {{--blood type  --}}
                                <div class="form-group">
                                    <label for="blood_type_id">{{__('general.blood_types.one')}}</label>
                                    <select name="blood_type_id" class = "form-control select2">
                                        <option value="">{{__('general.blood_types.select')}}</option>
                                        @foreach($blood_types as $blood_type)
                                            <option value="{{$blood_type->id}}" {{old('blood_type_id' == $blood_type->id ? 'selected' : '')}} >{{$blood_type->name}}</option>
                                        @endforeach       
                                    </select>
                                </div>        
                            </div>

                            <div class="col-md-3">
                                {{--nationalitiy  --}}
                                <div class="form-group">
                                    <label for="nationality_id">{{__('general.nationalities.one')}}</label>
                                    <select name="nationality_id" class = "form-control select2">
                                        <option value="">{{__('general.nationalities.select')}}</option>
                                        @foreach($nationalities as $nationality)
                                            <option value="{{$nationality->id}}" {{old('nationality_id' == $nationality->id ? 'selected' : '')}} >{{$nationality->name}}</option>
                                        @endforeach       
                                    </select>
                                </div>        
                            </div>

                            <div class="col-md-3">
                                {{--relision  --}}
                                <div class="form-group">
                                    <label for="relision_id">{{__('general.relisions.one')}}</label>
                                    <select name="relision_id" class = "form-control select2">
                                        <option value="">{{__('general.relisions.select')}}</option>
                                        @foreach($relisions as $relision)
                                            <option value="{{$relision->id}}" {{old('relision_id' == $relision->id ? 'selected' : '')}} >{{$relision->name}}</option>
                                        @endforeach       
                                    </select>
                                </div>        
                            </div>
                           
                        </div>



                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--address  --}}
                                <div class="form-group">
                                    <label for="address">{{__('students.address')}}</label>
                                    <textarea type="text" name = "address" class = "form-control" placeholder="{{__('students.address')}}">{{old('address')}}</textarea>
                                </div>        
                            </div>

                            <div class="col-md-6">
                                {{--notes  --}}
                                <div class="form-group">
                                    <label for="notes">{{__('students.notes')}}</label>
                                    <textarea type="text" name = "notes" class = "form-control" placeholder="{{__('students.notes')}}">{{old('notes')}}</textarea>
                                </div>        
                            </div>
                            
                        </div>


                        <div class="row mb-3">

                            <div class="col-md-3">
                                {{-- joinging date  --}}
                                    <div class="form-group">
                                        <label for="joining_date">{{__('students.joining_date')}}</label>
                                        <input type="date" name = "joining_date" class = "form-control" value = "{{old('joining_date')}}" placeholder="{{__('students.joining_date')}}">
                                    </div>      
                            </div>

                            <div class="col-md-3">
                                 {{-- educational stage --}}
                                <div class="form-group">
                                    <label for="educational_stage_id">{{__('general.educational_stages.one')}}</label>
                                    <select name="educational_stage_id" class = "form-control educational_stage_selected select2 select2-modal" style = "width: 100%;">
                                        <option value="">{{__('general.educational_stages.one')}}</option>
                                            @foreach($educational_stages as $educational_stage)
                                                <option value="{{$educational_stage->id}}" {{$educational_stage->id == old('educational_stage_id') ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                {{-- class room  --}}
                                <div class="form-group">
                                    <label for="class_room_id">{{__('general.class_rooms.one')}}</label>
                                    <select name="class_room_id" class = "form-control class_room_selected select2 select2-modal">
                                        
                                    </select>
                                </div>                
                            </div>

                           

                           
                        </div>



                        
                     
                         {{-- Active --}}
                         <br>
                         <div class="form-group">
                           <label for="active">{{__('general.active')}}</label>
                           <input type="checkbox" name = "active" class = "form-check-input" id = "active" {{old('active') ? 'checked' : ''}} >
                       </div>
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
    <script src="{{asset('dashboard/assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    

    <script>
        $(".select2").select2();
    </script>

@endpush