@extends('teachers.master')

@section('title' , __('quizzes.edit'))

@push('styles')

@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('quizzes.edit')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('teacher.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('teacher.quiz.index')}}">{{__('quizzes.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('quizzes.edit')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{$quiz->name}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('teacher.quiz.update' , $quiz->id)}}" method = "post">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <div class="col-md-12">
                                {{--name --}}
                                <div class="form-group">
                                    <label for="name">{{__('quizzes.name')}}</label>
                                    <input type="text" name = "name" class = "form-control @error('name') is-invalid @enderror" value = "{{$quiz->name}}" placeholder="{{__('quizzes.name')}}">
                                    @error('name')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                          
                        </div>



                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--time_in_minutes --}}
                                <div class="form-group">
                                    <label for="time_in_minutes">{{__('quizzes.time_in_minutes')}}</label>
                                    <input type="text" name = "time_in_minutes" class = "form-control @error('time_in_minutes') is-invalid @enderror" value = "{{$quiz->time_in_minutes}}" placeholder="{{__('quizzes.time_in_minutes')}}">
                                    @error('time_in_minutes')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>

                            <div class="col-md-6">
                                {{--status --}}
                                <div class="form-group">
                                    <label for="status">{{__('quizzes.status')}}</label>

                                    <select name="status" class = "form-control select2">
                                        <option value="pending" {{$quiz->status == 'pending' ? 'selected' : ''}} >{{__('quizzes.pending')}}</option>
                                        <option value="started" {{$quiz->status == 'started' ? 'selected' : ''}} >{{__('quizzes.started')}}</option>
                                        <option value="finished" {{$quiz->status == 'finished' ? 'selected' : ''}} >{{__('quizzes.finished')}}</option>
                                    </select>
                                   
                                    @error('status')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                        </div>



                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="subject_id">{{__('general.subjects.one')}}</label>
                                    <select name="subject_id" class = "form-control select2 @error('subject_id') is-invalid @enderror" placeholder = "{{__('general.subjects.select')}}">
                                        <option value="" disabled>{{__('general.subjects.select')}}</option>
                                        @foreach($subjects as $subject )
                                            <option value="{{$subject->id}}" {{$quiz->subject_id == $subject->id ? 'selected' : '' }}  >{{$subject->name_in_details}}</option>
                                        @endforeach
                                    </select>
                                    @error('subject_id')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>    
                            </div>
                        
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="educational_class_room_id">{{__('general.educational_class_rooms.one')}}</label>
                                    <select name="educational_class_room_id" class = "form-control select2 @error('educational_class_room_id') is-invalid @enderror" placeholder = "{{__('general.educational_class_rooms.select')}}">
                                        <option value="" disabled>{{__('general.educational_class_rooms.select')}}</option>
                                        @foreach($educational_class_rooms as $educational_class_room )
                                            <option value="{{$educational_class_room->id}}" {{$quiz->educational_class_room_id == $educational_class_room->id ? 'selected' : '' }}  >{{$educational_class_room->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('educational_class_room_id')
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
                                    <input type="checkbox" name = "active" class = "form-check-input @error('active') is-invalid @enderror" id = "active" {{$quiz->active ? 'checked' : ''}} >
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
                            {{__('general.edit')}}
                        </button>



                    </form>
                    
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
    

    
    <script>
         $(document).ready(function() {

            $('.preview').click(function() {
                $('#profile_picture').trigger('click')
            });
            $('#profile_picture').change(function(event) {
                var image = document.getElementById('profile_picture');
                image.src = URL.editObjectURL(event.target.files[0]);
                $('#cat-img').attr('src', image.src);
                $('#cat-img').css('display', 'block');
            });

            $(".select2").select2({
                theme : 'classic'
            });
    });

        
    </script>

@endpush