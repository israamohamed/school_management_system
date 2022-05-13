@extends('dashboard.master')

@section('title' , __('students.student_attendances.title'))

@push('styles')
<style>
   
</style>
@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('students.student_attendances.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('students.student_attendances.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')
{{-- Filters --}}
<div style = "margin: 10px 0;">
    <form method = "GET">
        <div class="row">
            <div class="col-md-3">
                <label for="educational_stage_id" class = "text-primary">{{__('students.student_attendances.attendance_date')}}</label>
                <input type="date" class = "form-control" name = "attendance_date" value = "{{request()->attendance_date ?? date('Y-m-d')}}" onchange="this.form.submit()">
                {{-- <select name="educational_stage_id" class = "form-control select2" onchange="this.form.submit()">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($educational_stages as $educational_stage)
                            <option value="{{$educational_stage->id}}" {{$educational_stage->id == request()->educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                        @endforeach
                </select> --}}
            </div>

            <div class="col-md-3">
                <label for="class_room_id" class = "text-primary">{{__('general.class_rooms.one')}}</label>
                
                <select name="class_room_id" class = "form-control select2 text-light" onchange="this.form.submit()">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($class_rooms as $class_room)
                            <option value="{{$class_room->id}}" {{$class_room->id == request()->class_room_id ? 'selected' : ''}} >{{$class_room->name . ' ' . ($class_room->educational_stage ? $class_room->educational_stage->name : '') }}</option>
                        @endforeach
                </select>
            </div>

        </div>
    </form>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('students.student_attendances.title')}}</h4>
                    <a href = "{{route('dashboard.student_attendance.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('general.add')}}</a>
                    
                    <div class="clearfix"></div>
                </div>
                @if(count($educational_class_rooms) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>

                                <tr>
                                    
                                    <th>#</th>
                                    <th>{{__('general.educational_stages.one')}}</th>
                                    <th>{{__('general.class_rooms.one')}}</th>
                                    <th>{{__('general.educational_class_rooms.one')}}</th>
                                    <th>{{__('general.number_of_students')}}</th>
                                    <th>{{__('students.student_attendances.attendant_number')}}</th>
                                    <th>{{__('students.student_attendances.absence_number')}}</th>
                                 
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($educational_class_rooms as $educational_class_room)
                                <tr>
                                
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$educational_class_room->class_room && $educational_class_room->class_room->educational_stage ? $educational_class_room->class_room->educational_stage->name : '--' }}</td>
                                    <td>{{$educational_class_room->class_room ? $educational_class_room->class_room->name : '--' }}</td>
                                    <td>{{$educational_class_room->name}}</td>
                                    <td>{{$educational_class_room->students_count}}</td> 
                                    <td>{{$educational_class_room->attendants_number}}</td> 
                                    <td>{{$educational_class_room->absence_number}}</td> 
                                   

                                    <td class="text-bold-500">
                                       {{--show--}}
                                       <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$educational_class_room->id}}"><i class = " far fa-eye"></i> </button>
                                       <a href="{{route('dashboard.student_attendance.create'  , [  'educational_stage_id' => $educational_class_room->class_room ? $educational_class_room->class_room->educational_stage_id : '' , 
                                                                                                    'class_room_id' => $educational_class_room->class_room_id ,     
                                                                                                    'educational_class_room_id' => $educational_class_room->id ,
                                                                                                    'academic_year' => date("Y") ,
                                                                                                    'attendance_date' => date("Y-m-d") ]  )}}" class = "btn btn-info btn-sm"><i class = "fas fa-clipboard-check"></i></a>
                                       @include('dashboard.student_attendances.show_modal')

                                    </td>
                                </tr>           
                                @endforeach            
                            </tbody>
                        </table>

                      

                    </div>


                {{$educational_class_rooms->appends($_GET)->links()}}
                <div>
                  
                </div>
                @else 
                    <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
 $(".select2").select2({
    theme: "classic"
 });
</script>

@endpush