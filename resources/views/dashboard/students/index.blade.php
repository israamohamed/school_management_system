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
                                        <button class = "btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$student->id}}"><i class = " far fa-eye"></i></button>
                                        @include('dashboard.students.show_modal')
                                        <a href = "{{route('dashboard.student.edit' , $student->id)}}" class = "btn btn-info btn-sm"><i class = "fas fa-edit"></i></a>
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$student->id}}"><i class = "fas fa-trash"></i></button>
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

<!-- Magnific Popup-->
<script src="{{asset('dashboard/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

<!-- lightbox init js-->
<script src="{{asset('dashboard/assets/js/pages/lightbox.init.js')}}"></script>

@endpush