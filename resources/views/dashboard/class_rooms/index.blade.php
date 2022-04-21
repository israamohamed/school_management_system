@extends('dashboard.master')

@section('title' , __('general.class_rooms.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.class_rooms.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.class_rooms.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')
{{-- Filters --}}
<div style = "margin: 10px 0;">
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
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.class_rooms.title')}}</h4>
                    <button type="button" class="btn btn-primary waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_modal">{{__('general.add')}}</button>
                    @include('dashboard.class_rooms.create')
                    <div class="clearfix"></div>
                </div>
                @if(count($class_rooms) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th><input type="checkbox" id = "check_all" class = "form-check-input"></th>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('general.educational_stages.one')}}</th>
                                    <th>{{__('general.last_class_room')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($class_rooms as $class_room)
                                <tr>
                                    <td><input type="checkbox" class = "select_row form-check-input" value = "{{$class_room->id}}"></td>
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                    <td>{{$class_room->name}}</td>
                                    <td>{{$class_room->educational_stage->name}}</td>
                                    <td>{!! $class_room->last_class_room ? '<i class="fas fa-check"></i>' : '<i class="far fa-window-close"></i>' !!}</td>
                                    <td class="text-bold-500">
                                        <button class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#edit_modal_{{$class_room->id}}">{{__('general.edit')}}</button>
                                        <button class = "btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$class_room->id}}">{{__('general.delete')}}</button>
                                        @include('dashboard.class_rooms.edit')
                                        @include('dashboard.class_rooms.delete')
                                    </td>
                                </tr>           
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$class_rooms->links()}}
                <div>
                    <form action="{{route('dashboard.class_room.delete_selected')}}" id = "delete_selected_form" method = "post">
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