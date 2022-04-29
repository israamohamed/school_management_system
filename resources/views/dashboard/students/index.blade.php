@extends('dashboard.master')

@section('title' , __('students.title'))

@push('styles')
    <!-- Lightbox css -->
    <link href="{{asset('dashboard/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />

@endpush

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

{{-- Filters --}}
<div style = "margin: 10px 0;">
    <form method = "GET">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name = "search" class = "form-control" value = "{{request()->search}}" onchange="this.form.submit()" placeholder="{{__('general.search')}}">
            </div>

            <div class="col-md-3 educational_stage_selected_parent">
                <select name="educational_stage_id" class = "form-control select2 educational_stage_selected"  onchange="this.form.submit()" placeholder="{{__('general.educational_stages.one')}}">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($educational_stages as $educational_stage)
                            <option value="{{$educational_stage->id}}" {{$educational_stage->id == request()->educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                        @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="class_room_id" class = "form-control select2 class_room_selected"  onchange="this.form.submit()" placeholder="{{__('general.class_rooms.one')}}">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($class_rooms as $class_room)
                            <option value="{{$class_room->id}}" {{$class_room->id == request()->class_room_id ? 'selected' : ''}} >{{$class_room->name}}</option>
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
                                    <th>{{__('general.image')}}</th>
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
                                    <td>
                                        <a class="image-popup-no-margins" href="{{$student->profile_picture}}">
                                            <img style = "height: 100px;" src="{{$student->profile_picture}}" alt="">
                                        </a>
                                    </td>
                                    <td>{{$student->name}}</td>
                                    <td>{{$student->educational_stage() ? $student->educational_stage()->name : '--'}}</td>
                                    <td>{{$student->class_room ? $student->class_room->name : '--'}}</td>
                                    <td>{{$student->educational_class_room ? $student->educational_class_room->name : '--' }}</td>
                                
                                    <td>{!! $student->active ? '<button class = "btn btn-success  btn-sm"><i class="fas fa-check"></i></button>' : '<button class = "btn btn-danger  btn-sm"><i class="far fa-window-close"></i></button>' !!}</td>

                                    <td>
                                        <div class="btn-group me-1 mt-2">
                                            <button class="btn btn-info btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{__('general.options')}} <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                {{--show--}}
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#show_modal_{{$student->id}}"><i class = " far fa-eye  text-warning"></i> {{__('general.show')}}</button>
                                                {{--edit--}}
                                                <a class="dropdown-item" href="{{route('dashboard.student.edit' , $student->id)}}"><i class = "fas fa-edit text-primary"></i> {{__('general.edit')}}</a>
                                                {{--add invoice--}}
                                                <a class="dropdown-item" href="{{route('dashboard.student_invoice.create' , ['student_id' => $student->id])}}"><i class = "fas fa-file-invoice-dollar text-success"></i> {{__('general.add_invoice')}}</a>

                                                {{--add financial bond--}}
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#financial_modal_{{$student->id}}"><i class = "fas fa-money-bill-alt  text-dark"></i> {{__('general.add_financial_bond')}}</button>

                                                {{--delete--}}
                                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$student->id}}"><i class = "fas fa-trash text-danger"></i> {{__('general.delete')}}</button>
                                                
                                                
                                            </div>

                                            @include('dashboard.students.show_modal')
                                            @include('dashboard.students.financial_modal')
                                            @include('dashboard.students.delete')
                                        </div>
                                        {{-- <button class = "btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$student->id}}"><i class = " far fa-eye"></i></button>
                                        @include('dashboard.students.show_modal')
                                        <a href = "{{route('dashboard.student.edit' , $student->id)}}" class = "btn btn-info btn-sm"><i class = "fas fa-edit"></i></a>
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$student->id}}"><i class = "fas fa-trash"></i></button>
                                        @include('dashboard.students.delete') --}}
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

<!-- Magnific Popup-->
<script src="{{asset('dashboard/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- lightbox init js-->
<script src="{{asset('dashboard/assets/js/pages/lightbox.init.js')}}"></script>

<script>
    $(".select2").each(function(ele){
        var placeholder = $(this).attr("placeholder");

        $(this).select2({
            placeholder:  placeholder,
        });
    });

    /*$(".select2").select2({
        placeholder:  $(this).attr("placeholder"),
    });*/
</script>
<script>
    $(".select2-modal").each(function(){
        var parent = $(this).closest(".modal")
        $(this).select2({
            dropdownParent: parent
        });

    });

</script>

@endpush