@extends('dashboard.master')

@section('title' , __('students.graduated_students.create'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('students.graduated_students.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.graduated_student.index')}}">{{__('students.graduated_students.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('students.graduated_students.create')}}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('students.graduated_students.create')}}</h4>
                    
                    <div class="clearfix"></div>
                </div>


                {{-- Filters --}}
                
                    <form method = "GET">
                        <div class="row">
                            <div class="col-md-3 educational_stage_selected_parent">
                                {{-- educational stage --}}
                               <div class="form-group"> 
                                   <label for="previous_educational_stage_id">{{__('students.graduated_students.previous_educational_stage')}}</label>
                                   <select name="previous_educational_stage_id" class = "form-control educational_stage_selected select2  @error('previous_educational_stage_id') is-invalid @enderror" style = "width: 100%;">
                                       <option value="">{{__('general.educational_stages.select')}}</option>
                                           @foreach($educational_stages as $educational_stage)
                                               <option value="{{$educational_stage->id}}" {{$educational_stage->id == request()->previous_educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                                           @endforeach
                                   </select>
                                  
                               </div>
                           </div>

                           <div class="col-md-3 class_room_selected_parent">
                               {{-- class room  --}}
                               <div class="form-group">
                                   <label for="previous_class_room_id">{{__('students.graduated_students.previous_class_room')}}</label>
                                   <select name="previous_class_room_id"  data-educational_class_room_id = "{{request()->previous_educational_class_room_id}}" class = "form-control class_room_selected select2  @error('class_room_id') is-invalid @enderror">
                                       
                                   </select>
                                  
                               </div>                
                           </div>

                           <div class="col-md-3">
                               {{-- educational class room  --}}
                               <div class="form-group">
                                   <label for="previous_educational_class_room_id">{{__('students.graduated_students.previous_educational_class_room')}}</label>
                                   <select name="previous_educational_class_room_id" class = "form-control educational_class_room_selected select2 @error('previous_educational_class_room_id') is-invalid @enderror">
                                       
                                   </select>
                                  
                               </div>                
                           </div>

                           <div class="col-md-3">
                                {{-- previous academic year  --}}
                                <div class="form-group">
                                    <label for="previous_academic_year">{{__('students.graduated_students.previous_academic_year')}}</label>
                                    <select name="previous_academic_year" class = "form-control select2 @error('previous_academic_year') is-invalid @enderror">
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year}}" {{request()->previous_academic_year == $year ? 'selected' : ''}} >{{ $year }}</option>
                                        @endfor
                                    </select>              
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
                    <div class="table-responsive mb-2 border border-success" style = "height: 200px;">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th><input type="checkbox" id = "check_all" class = "form-check-input"></th>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('students.code')}}</th>
                                    <th>{{__('general.educational_stages.one')}}</th>
                                    <th>{{__('general.class_rooms.one')}}</th>
                                    <th>{{__('general.educational_class_rooms.one')}}</th>
                                    <th></th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td><input type="checkbox" class = "select_row form-check-input" value = "{{$student->id}}"></td>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$student->name }}</td>
                                    <td>{{$student->code }}</td>
                                    <td>{{$student->educational_stage() ? $student->educational_stage()->name : '--'}}</td>
                                    <td>{{$student->class_room ? $student->class_room->name : '--'}}</td>
                                    <td>{{$student->educational_class_room ? $student->educational_class_room->name : '--' }}</td>
                                    <td>
                                        <button class = "btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$student->id}}"><i class = " far fa-eye"></i></button>
                                        @include('dashboard.students.show_modal')
                                    </td>
                                </tr>           
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                

                    @include('dashboard.graduated_students.next_data_form')
                
                @else 
                    <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif



            </div>
        </div>
    </div>
</div>

@endsection

@include('dashboard.scripts.change_educatioanl_data')

@push('scripts')

@if(request()->previous_educational_stage_id)
    <script>
        change_class_rooms($("select[name='previous_educational_stage_id']") , "{{request()->previous_class_room_id}}"  );
    </script>
@endif
<script>

    $(".select2").select2();

   $("#delete_selected").click(function(){

    if($(".select_row:checked").length > 0) {

        var warning = "{{__('messages.deleted_rows_warning' , ['number' => ':number' ])}}";
        warning = warning.replace(":number" , $(".select_row:checked").length);
      
        Swal.fire({
            title: "{{__('messages.are_you_sure')}}",
            text:  warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: "{{__('general.delete')}}"
        }).then((result) => {
                if (result.isConfirmed) {
                   $("#delete_selected_form").submit();
                }
         })
    }
    else {
        toastr.error("{{__('messages.no_rows_selected')}}")
    }

   });
</script>

@endpush