@extends('teachers.master')

@section('title' , __('online_classes.create'))

@push('styles')

@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('online_classes.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('teacher.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('teacher.online_class.index')}}">{{__('online_classes.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('online_classes.create')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('online_classes.create')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('teacher.online_class.store')}}" method = "post">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                {{--topic --}}
                                <div class="form-group">
                                    <label for="topic">{{__('online_classes.topic')}}</label>
                                    <input type="text" name = "topic" class = "form-control @error('topic') is-invalid @enderror" value = "{{old('topic')}}" placeholder="{{__('online_classes.topic')}}">
                                    @error('topic')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                          
                        </div>



                        <div class="row mb-3">

                            <div class="col-md-6">
                                {{--start_time --}}
                                <div class="form-group">
                                    <label for="start_time">{{__('online_classes.start_time')}}</label>
                                    <input type="datetime-local" name = "start_time" class = "form-control @error('start_time') is-invalid @enderror" value = "{{old('start_time')}}" placeholder="{{__('online_classes.start_time')}}">
                                    @error('start_time')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>

                            <div class="col-md-6">
                                {{--duration --}}
                                <div class="form-group">
                                    <label for="duration">{{__('online_classes.duration')}}</label>
                                    <input type="text" name = "duration" class = "form-control @error('duration') is-invalid @enderror" value = "{{old('duration')}}" placeholder="{{__('online_classes.duration')}}">
                                    @error('duration')
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
                                    <label for="educational_class_room_id">{{__('general.educational_class_rooms.one')}}</label>
                                    <select name="educational_class_rooms[]" class = "form-control select2 @error('educational_class_rooms') is-invalid @enderror"  multiple="multiple" placeholder = "{{__('teachers.select_teacher_educational_class_rooms')}}">
                                        <option value="" disabled>{{__('teachers.select_teacher_educational_class_rooms')}}</option>
                                        @foreach($educational_class_rooms as $educational_class_room )
                                            <option value="{{$educational_class_room->id}}" {{old('educational_class_rooms') &&  in_array($educational_class_room->id , old('educational_class_rooms')) ? 'selected' : '' }}  >{{$educational_class_room->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('educational_class_rooms')
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

@push('scripts')

   <script>
       $(".select2").select2();
   </script>

  
@endpush