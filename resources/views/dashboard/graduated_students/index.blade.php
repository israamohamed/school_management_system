@extends('dashboard.master')

@section('title' , __('students.graduated_students.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('students.graduated_students.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('students.graduated_students.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')
{{-- Filters --}}
{{-- <div style = "margin: 10px 0;">
    <form method = "GET">
        <div class="row">
            <div class="col-md-3">
                <label for="educational_stage_id">{{__('general.educational_stages.one')}}</label>
                <select name="educational_stage_id" class = "form-control select2" onchange="this.form.submit()">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($educational_stages as $educational_stage)
                            <option value="{{$educational_stage->id}}" {{$educational_stage->id == request()->educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                        @endforeach
                </select>
            </div>
        </div>
    </form>
</div> --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('students.graduated_students.title')}}</h4>
                    <a href = "{{route('dashboard.graduated_student.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('general.add')}}</a>
                    
                    <div class="clearfix"></div>
                </div>
                @if(count($graduated_students) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>

                                <tr>
                                    <th><input type="checkbox" id = "check_all" class = "form-check-input"></th>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('general.created_at')}}</th>
                                    

                                    <th>{{__('students.graduated_students.previous_academic_year')}}</th>

                                    <th>{{__('students.graduated_students.previous_educational_stage')}}</th>

                                    <th>{{__('students.graduated_students.previous_class_room')}}</th>
                                    
                                    <th>{{__('students.graduated_students.previous_educational_class_room')}}</th>

                                    <th class = "text-center">{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($graduated_students as $graduated_student)
                                <tr>
                                    <td><input type="checkbox" class = "select_row form-check-input" value = "{{$graduated_student->id}}"></td>
                                    <td>{{$loop->iteration}}</td>
                                    
                                    <td>
                                        @php $student = $graduated_student->student  @endphp
                                        @if($student)
                                            <button class="btn btn-outline-dark waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#show_modal_{{$student->id}}"> {{$graduated_student->student ? $graduated_student->student->name : ''}}</button>
                                            @include('dashboard.students.show_modal')
                                        @endif
                                    </td>

                                    <td>{{$graduated_student->created_at}}</td>

                                    <td>{{$graduated_student->previous_academic_year}}</td>

                                    <td>{{$graduated_student->previous_educational_stage() ? $graduated_student->previous_educational_stage()->name : ''  }}</td>

                                    <td>{{$graduated_student->previous_class_room ? $graduated_student->previous_class_room->name : ''  }}</td>
                                   
                                    <td>{{$graduated_student->previous_educational_class_room ? $graduated_student->previous_educational_class_room->name : ''  }}</td>

                                 


                                    <td class="text-bold-500">
                                       
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#return_modal_{{$graduated_student->id}}" title = "{{__('general.return_upgrade')}}"><i class = "fas fa-sign-in-alt"></i></button>
                                        @include('dashboard.graduated_students.return_modal')

                                    </td>
                                </tr>           
                                @endforeach            
                            </tbody>
                        </table>

                      

                    </div>

                    <form action="{{route('dashboard.graduated_student.return_multiple_students')}}" id = "return_multiple_students_form" method = "post">
                        @csrf
                        <input type="hidden" name = "selected_rows">

                        <button type = "button" class = "btn btn-danger btn-sm" id = "return_multiple_students_selected">{{__('general.return_upgrade_selected')}}</button>

                    </form>   
                {{$graduated_students->links()}}
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
   $("#return_multiple_students_selected").click(function(){

    if($(".select_row:checked").length > 0) {

        var warning = "{{__('messages.graduate_rows_warning' , ['number' => ':number' ])}}";
        warning = warning.replace(":number" , $(".select_row:checked").length);
      
        Swal.fire({
            title: "{{__('messages.are_you_sure')}}",
            text:  warning,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: "{{__('general.confirm')}}"
        }).then((result) => {
                if (result.isConfirmed) {
                   $("#return_multiple_students_form").submit();
                }
         })
    }
    else {
        toastr.error("{{__('messages.no_students_selected')}}")
    }

   });
</script>

@endpush