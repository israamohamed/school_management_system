@extends('dashboard.master')

@section('title' , __('students.student_upgrades.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('students.student_upgrades.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('students.student_upgrades.title')}}</li>
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
                    <h4 class = "float-start">{{__('students.student_upgrades.title')}}</h4>
                    <a href = "{{route('dashboard.student_upgrade.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('general.add')}}</a>
                    
                    <div class="clearfix"></div>
                </div>
                @if(count($student_upgrades) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>

                                <tr>
                                    <th><input type="checkbox" id = "check_all" class = "form-check-input"></th>
                                    <th>#</th>
                                    <th class = "text-center table-warning">{{__('general.name')}}</th>

                                    <th class = "text-center table-success">{{__('students.student_upgrades.previous_educational_stage')}}</th>
                                    
                                    <th class = "text-center table-success">{{__('students.student_upgrades.previous_educational_class_room')}}</th>

                                    <th class = "text-center table-danger">{{__('students.student_upgrades.next_educational_stage')}}</th>
                                    
                                    <th class = "text-center table-danger">{{__('students.student_upgrades.next_educational_class_room')}}</th>

                                    <th class = "text-center">{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student_upgrades as $student_upgrade)
                                <tr>
                                    <td><input type="checkbox" class = "select_row form-check-input" value = "{{$student_upgrade->id}}"></td>
                                    <td>{{$loop->iteration}}</td>
                                    <td class = "text-center table-warning">
                                        @php $student = $student_upgrade->student  @endphp
                                        @if($student)
                                            <button class = "btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$student->id}}"> {{$student_upgrade->student ? $student_upgrade->student->name : ''}}</button>
                                            @include('dashboard.students.show_modal')
                                        @endif           
                                    </td>
                                   
                                    <td class = "text-center table-success">
                                        {{$student_upgrade->previous_academic_year}}
                                        <br>
                                        {{$student_upgrade->previous_educational_stage() ? $student_upgrade->previous_educational_stage()->name : ''  }}
                                        <br>
                                        {{$student_upgrade->previous_class_room ? $student_upgrade->previous_class_room->name : ''  }}
                                    </td>
                                    
                                    <td class = "text-center table-success">{{$student_upgrade->previous_educational_class_room ? $student_upgrade->previous_educational_class_room->name : ''  }}</td>

                                    <td class = "text-center table-danger">
                                        {{$student_upgrade->next_academic_year}}
                                        <br>
                                        {{$student_upgrade->next_educational_stage() ? $student_upgrade->next_educational_stage()->name : ''  }}
                                        <br>
                                        {{$student_upgrade->next_class_room ? $student_upgrade->next_class_room->name : ''  }}
                                    </td>
                                    
                                    <td class = "text-center table-danger">{{$student_upgrade->next_educational_class_room ? $student_upgrade->next_educational_class_room->name : ''  }}</td>



                                    <td class="text-bold-500">
                                       
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#return_modal_{{$student_upgrade->id}}" title = "{{__('general.return_upgrade')}}"><i class = "fas fa-sign-in-alt"></i></button>
                                        @include('dashboard.student_upgrades.return_modal')

                                    </td>
                                </tr>           
                                @endforeach            
                            </tbody>
                        </table>

                      

                    </div>

                    <form action="{{route('dashboard.student_upgrade.return_multiple_students')}}" id = "return_multiple_students_form" method = "post">
                        @csrf
                        <input type="hidden" name = "selected_rows">

                        <button type = "button" class = "btn btn-danger btn-sm" id = "return_multiple_students_selected">{{__('general.return_upgrade_selected')}}</button>

                    </form>   
                {{$student_upgrades->links()}}
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

        var warning = "{{__('messages.upgrade_rows_warning' , ['number' => ':number' ])}}";
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