@extends('dashboard.master')

@section('title' , __('general.subjects.title'))

@push('styles')

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.subjects.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.subjects.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

{{-- Filters --}}
<div style = "margin: 10px 0;">
    <form method = "GET">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name = "search" class = "form-control" value = "{{request()->search}}" onchange="this.form.submit()" placeholder="{{__('general.search')}}">
            </div>

            {{-- <div class="col-md-3 educational_stage_selected_parent">
                <select name="educational_stage_id" class = "form-control select2 educational_stage_selected"  onchange="this.form.submit()" placeholder="{{__('general.educational_stages.one')}}">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($educational_stages as $educational_stage)
                            <option value="{{$educational_stage->id}}" {{$educational_stage->id == request()->educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                        @endforeach
                </select>
            </div> --}}

            {{-- <div class="col-md-3">
                <select name="class_room_id" class = "form-control select2 class_room_selected"  onchange="this.form.submit()" placeholder="{{__('general.class_rooms.one')}}">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($class_rooms as $class_room)
                            <option value="{{$class_room->id}}" {{$class_room->id == request()->class_room_id ? 'selected' : ''}} >{{$class_room->name}}</option>
                        @endforeach
                </select>
            </div> --}}

        </div>
    </form>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.subjects.title')}} <span class="badge rounded-pill bg-dark">{{$subjects->total()}}</span> </h4>
                    <a href = "{{route('dashboard.subject.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('general.subjects.create')}}</a>
                
                    <div class="clearfix"></div>
                </div>

               
                @if(count($subjects) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th><input type="checkbox" id = "check_all" class = "form-check-input"></th>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                   
                                    <th>{{__('general.educational_stages.one')}}</th>
                                    <th>{{__('general.class_rooms.one')}}</th>
                                    <th>{{__('general.subjects.upper_grade')}}</th>
                                    <th>{{__('general.subjects.lower_grade')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjects as $subject)
                                <tr>
                                    <td><input type="checkbox" class = "select_row form-check-input" value = "{{$subject->id}}"></td>

                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                 
                                    <td>{{$subject->name}}</td>

                                    <td>{{$subject->educational_stage() ? $subject->educational_stage()->name : '--' }}</td>
                                
                                    <td>{{$subject->class_room ? $subject->class_room->name : '--'}}</td>
                                    <td>{{$subject->upper_grade}}</td>
                                    <td>{{$subject->lower_grade}}</td>

                                    <td>
                                        <a href = "{{route('dashboard.subject.edit' , $subject->id)}}" class = "btn btn-info btn-sm"><i class = "fas fa-edit"></i></a>
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$subject->id}}"><i class = "fas fa-trash"></i></button>
                                        @include('dashboard.subjects.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$subjects->links()}}
                <div>
                    <form action="{{route('dashboard.subject.delete_selected')}}" id = "delete_selected_form" method = "post">
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

@include('dashboard.scripts.change_educatioanl_data')

@push('scripts')

<script>
    $(".select2").each(function(ele){
        var placeholder = $(this).attr("placeholder");

        $(this).select2({
            placeholder:  placeholder,
        });
    });

</script>

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