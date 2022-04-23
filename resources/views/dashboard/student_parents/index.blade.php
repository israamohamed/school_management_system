@extends('dashboard.master')

@section('title' , __('student_parents.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('student_parents.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('student_parents.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')
{{-- Filters --}}
<div style = "margin: 10px 0;">
    <form method = "GET">
        <div class="row">
            <div class="col-md-3">
                {{-- <label for="educational_stage_id">{{__('general.educational_stages.one')}}</label>
                <select name="educational_stage_id" class = "form-control select2" onchange="this.form.submit()">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($educational_stages as $educational_stage)
                            <option value="{{$educational_stage->id}}" {{$educational_stage->id == request()->educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                        @endforeach
                </select> --}}
            </div>
        </div>
    </form>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('student_parents.title')}}</h4>
                    <a href = "{{route('dashboard.student_parent.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('student_parents.create')}}</a>
                   
                    <div class="clearfix"></div> 
                </div>
                @if(count($student_parents) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th><input type="checkbox" id = "check_all" class = "form-check-input"></th>
                                    <th>#</th>
                                    <th>{{__('student_parents.father_name')}}</th>
                                    <th>{{__('student_parents.father_phone_number')}}</th>
                                    <th>{{__('student_parents.mother_name')}}</th>
                                    <th>{{__('student_parents.mother_phone_number')}}</th>
                                    <th>{{__('student_parents.email')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student_parents as $student_parent)
                                <tr>
                                    <td><input type="checkbox" class = "select_row form-check-input" value = "{{$student_parent->id}}"></td>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$student_parent->father_name}}</td>
                                    <td>{{$student_parent->father_phone_number}}</td>
                                    <td>{{$student_parent->mother_name}}</td>
                                    <td>{{$student_parent->mother_phone_number}}</td>
                                    <td>{{$student_parent->email}}</td>
                                   
                                    <td class="text-bold-500">
                                        <a href = "{{route('dashboard.student_parent.edit' , $student_parent->id)}}" class = "btn btn-info">{{__('general.edit')}}</a>

                                        <button class = "btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$student_parent->id}}">{{__('general.delete')}}</button>
                        
                                        @include('dashboard.student_parents.delete')
                                      
                                    </td>
                                </tr>           
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$student_parents->links()}}
                <div>
                    <form action="{{route('dashboard.student_parent.delete_selected')}}" id = "delete_selected_form" method = "post">
                        @csrf
                        <input type="hidden" name = "selected_rows">

                        <button type = "button" class = "btn btn-danger btn-sm" id = "delete_selected">{{__('general.delete_all')}}</button>

                    </form>                    
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