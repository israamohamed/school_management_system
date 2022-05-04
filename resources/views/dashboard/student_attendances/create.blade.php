@extends('dashboard.master')

@section('title' , __('students.student_attendances.create'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('students.student_attendances.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.student_attendance.index')}}">{{__('students.student_attendances.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('students.student_attendances.create')}}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('students.student_attendances.create')}}</h4>
                    
                    <div class="clearfix"></div>
                </div>


                {{-- Filters --}}
                
                    <form method = "GET">
                        <div class="row">
                            <div class="col-md-3 educational_stage_selected_parent">
                                {{-- educational stage --}}
                               <div class="form-group"> 
                                   <label for="educational_stage_id">{{__('general.educational_stages.one')}}</label>
                                   <select name="educational_stage_id" class = "form-control educational_stage_selected select2  @error('educational_stage_id') is-invalid @enderror" style = "width: 100%;" required>
                                       <option value="">{{__('general.educational_stages.select')}}</option>
                                           @foreach($educational_stages as $educational_stage)
                                               <option value="{{$educational_stage->id}}" {{$educational_stage->id == request()->educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                                           @endforeach
                                   </select>
                                  
                               </div>
                           </div>

                           <div class="col-md-3 class_room_selected_parent">
                               {{-- class room  --}}
                               <div class="form-group">
                                   <label for="class_room_id">{{__('general.class_rooms.one')}}</label>
                                   <select name="class_room_id"  data-educational_class_room_id = "{{request()->educational_class_room_id}}" class = "form-control class_room_selected select2  @error('class_room_id') is-invalid @enderror" required>
                                       
                                   </select>
                                  
                               </div>                
                           </div>

                           <div class="col-md-3">
                               {{-- educational class room  --}}
                               <div class="form-group">
                                   <label for="educational_class_room_id">{{__('general.educational_class_rooms.one')}}</label>
                                   <select name="educational_class_room_id" class = "form-control educational_class_room_selected select2 @error('educational_class_room_id') is-invalid @enderror" required>
                                       
                                   </select>
                                  
                               </div>                
                           </div>

                           <div class="col-md-3">
                                {{-- academic year  --}}
                                <div class="form-group">
                                    <label for="academic_year">{{__('general.academic_year')}}</label>
                                    <select name="academic_year" class = "form-control select2 @error('academic_year') is-invalid @enderror" required>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<$current_year +1 ;$year++)
                                            <option value="{{ $year}}" {{request()->academic_year == $year ? 'selected' : ''}} >{{ $year }}</option>
                                        @endfor
                                    </select>              
                                </div>                
                            </div>

                            <div class="col-md-3">
                                {{-- attendance date  --}}
                                <div class="form-group">
                                    <label for="attendance_date">{{__('students.student_attendances.attendance_date')}}</label>

                                    <input type="date" name = "attendance_date" class = "form-control @error('attendance_date') is-invalid @enderror" required value = "{{ request()->attendance_date ?? date("Y-m-d") }}">        
                                </div>                
                            </div>
                        </div>

                        </div>

                       

                        <div class="row m-3">
                            <div class="col-md-12 text-center">
                                <button type="submit" class = "btn btn-success btn-lg" style = "font-size: 1.3em;width: 20%;">
                                    <i class = "fas fa-search"></i> {{__('general.search')}}
                                </button>
                            </div>
                        </div> 
                        
                    </form>
                


                {{-- students table --}}
                @if(count($students) > 0)

                    <h3 class = "alert-success p-2 text-center">{{__('students.list')}} ({{count($students)}})</h3>
                    <div class="table-responsive m-2 border border-success" style = "">

                        <form action="{{route('dashboard.student_attendance.store')}}" method = "post">
                            @csrf

                            <input type="hidden" name = "class_room_id"             value = "{{request()->class_room_id}}">
                            <input type="hidden" name = "educational_class_room_id" value = "{{request()->educational_class_room_id}}">
                            <input type="hidden" name = "academic_year"             value = "{{request()->academic_year}}">
                            <input type="hidden" name = "attendance_date"           value = "{{request()->attendance_date}}">

                            <table class="table table-bordered mb-0">

                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('general.name')}}</th>
                                        <th>{{__('students.code')}}</th>
                                    
                                        <th>{{__('general.educational_class_rooms.one')}}</th>
                                        <th>{{__('students.student_attendances.attendance_status')}}</th>
                                        <th>{{__('general.notes')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    @php $student_attendance = $student->attendances->first();   @endphp
                                  
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            <input type="hidden" name = "students[{{$student->id}}][student_id]" value = "{{$student->id}}" >
                                            {{$student->name }}
                                        </td>
                                        <td>{{$student->code }}</td>
                                    
                                        <td>{{$student->educational_class_room ? $student->educational_class_room->name : '--' }}</td>
                                        <td class = "attendance_status_parent">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input attendance_status" type="radio" name="students[{{$student->id}}][attendance_status]" value = "attendant" id="attend{{$student->id}}" {{$student_attendance && $student_attendance->attendance_status === 1 ? 'checked' : '' }} >
                                                        <label class="form-check-label" for="attend{{$student->id}}"> {{__('students.student_attendances.attendant')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input attendance_status" type="radio" name="students[{{$student->id}}][attendance_status]" value = "absent" id="absence{{$student->id}}"  {{$student_attendance && $student_attendance->attendance_status === 0 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="absence{{$student->id}}"> {{__('students.student_attendances.absent')}}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <select name="students[{{$student->id}}][absence_reason_id]" class = "absence_reason form-control select2 " style = "width: 100%;" {{$student_attendance && $student_attendance->attendance_status == false ? '' : 'disabled' }}>
                                                <option value="">{{__('general.absence_reasons.select')}}</option>
                                                @foreach($absence_reasons as $absence_reason)
                                                    <option value="{{$absence_reason->id}}" {{$student_attendance && $student_attendance->absence_reason_id == $absence_reason->id ? 'selected' : ''  }}>{{$absence_reason->name}}</option>
                                                @endforeach

                                            </select>
                                        </td>
                                 
                                    </tr>           
                                    @endforeach            
                                </tbody>
                            </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class = "btn btn-danger btn-lg float-end" style = "font-size: 1.3em;width: 20%;">
                                <i class = "fas fa-check-double"></i> {{__('general.save')}}
                            </button>
                        </div>
                </form>
                

                   
                
                @else 
                    <p class="text-danger m-2" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif



            </div>
        </div>
    </div>
</div>

@endsection

@include('dashboard.scripts.change_educatioanl_data')

@push('scripts')

@if(request()->educational_stage_id)
    <script>
        change_class_rooms($("select[name='educational_stage_id']") , "{{request()->class_room_id}}"  );
    </script>
@endif
<script>

    $(".select2").select2();

</script>

<script>
    $(".attendance_status").change(function(){

        var select = $(this).closest(".attendance_status_parent").next().find(".absence_reason");
        console.log(select);
        if($(this).val() == 'absent')
        {
            //select.show();
            select.prop("disabled", false);
        }

        else if($(this).val() == 'attendant')
        {
            //select.hide();
            select.prop("disabled", true);
        }
    });
</script>

@endpush