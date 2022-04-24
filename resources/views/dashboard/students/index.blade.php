@extends('dashboard.master')

@section('title' , __('students.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('students.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('students.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('students.title')}} <span class="badge rounded-pill bg-dark">{{$students->total()}}</span> </h4>
                    <a href = "{{route('dashboard.student.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('students.create')}}</a>
                
                    <div class="clearfix"></div>
                </div>

               
                @if(count($students) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('general.educational_stages.one')}}</th>
                                    <th>{{__('general.class_rooms.one')}}</th>
                                    <th>{{__('general.educational_class_rooms.one')}}</th>
                                    <th>{{__('general.active')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                <tr>
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->educational_stage ? $student->educational_stage->name : '--'}}</td>
                                    <td>{{$student->class_room ? $student->class_room->name : '--'}}</td>
                                    {{-- <td>{{$student->class_room && $student->class_room->educational_stage ? $student->class_room->educational_stage->name : '--' }}</td> --}}
                                    <td>{{$student->educational_class_room ? $student->educational_class_room->name : '--' }}</td>
                                    <td>{{$student->number_of_students}}</td>
                                    <td>{!! $student->active ? '<button class = "btn btn-success"><i class="fas fa-check"></i></button>' : '<button class = "btn btn-danger"><i class="far fa-window-close"></i></button>' !!}</td>

                                    <td>
                                        <a href = "{{route('dashboard.student.edit' , $student->id)}}" class = "btn btn-info">{{__('general.edit')}}</a>
                                        <button class = "btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$student->id}}">{{__('general.delete')}}</button>
                                        @include('dashboard.students.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$students->links()}}
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