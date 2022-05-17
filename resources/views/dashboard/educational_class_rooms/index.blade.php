@extends('dashboard.master')

@section('title' , __('general.educational_class_rooms.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.educational_class_rooms.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.educational_class_rooms.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.educational_class_rooms.title')}} <span class="badge rounded-pill bg-dark">{{$educational_class_rooms->total()}}</span> </h4>
                    <button type="button" class="btn btn-primary waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_modal"  {{ auth()->user()->can('create.educational_class_room') ? '' : 'disabled'}}>{{__('general.add')}}</button>
                    @include('dashboard.educational_class_rooms.create')
                    <div class="clearfix"></div>
                </div>

               
                @if(count($educational_class_rooms) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('general.educational_stages.one')}}</th>
                                    <th>{{__('general.class_rooms.one')}}</th>
                                    <th>{{__('general.number_of_students')}}</th>
                                    <th>{{__('general.active')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($educational_class_rooms as $educational_class_room)
                                <tr>
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                    <td>{{$educational_class_room->name}}</td>
                                    <td>{{$educational_class_room->class_room && $educational_class_room->class_room->educational_stage ? $educational_class_room->class_room->educational_stage->name : '--' }}</td>
                                    <td>{{$educational_class_room->class_room ? $educational_class_room->class_room->name : '--' }}</td>
                                    <td>{{$educational_class_room->number_of_students}}</td>
                                    <td>{!! $educational_class_room->active ? '<button class = "btn btn-success"><i class="fas fa-check"></i></button>' : '<button class = "btn btn-danger"><i class="far fa-window-close"></i></button>' !!}</td>

                                    <td>
                                        <button class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#edit_modal_{{$educational_class_room->id}}"  {{ auth()->user()->can('edit.educational_stage') ? '' : 'disabled'}}>{{__('general.edit')}}</button>
                                        <button class = "btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$educational_class_room->id}}"  {{ auth()->user()->can('delete.educational_stage') ? '' : 'disabled'}}>{{__('general.delete')}}</button>

                                        @include('dashboard.educational_class_rooms.edit')
                                        @include('dashboard.educational_class_rooms.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$educational_class_rooms->links()}}
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

$(".select2-modal").each(function(){
    var parent = $(this).closest(".modal")
    $(this).select2({
        dropdownParent: parent
    });

});
</script>
@endpush