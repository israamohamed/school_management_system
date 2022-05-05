@extends('dashboard.master')

@section('title' , __('teachers.title'))

@push('styles')
    <!-- Lightbox css -->
    <link href="{{asset('dashboard/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('teachers.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('teachers.title')}}</li>
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

            <div class="col-md-3">
                <select name="subject_id" class = "form-control select2 subject_selected"  onchange="this.form.submit()" placeholder="{{__('general.subjects.one')}}">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($subjects as $subject)
                            <option value="{{$subject->id}}" {{$subject->id == request()->subject_id ? 'selected' : ''}} >{{$subject->name_in_details}}</option>
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
                    <h4 class = "float-start">{{__('teachers.title')}} <span class="badge rounded-pill bg-dark">{{$teachers->total()}}</span> </h4>
                    <a href = "{{route('dashboard.teacher.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('teachers.create')}}</a>
                
                    <div class="clearfix"></div>
                </div>

               
                @if(count($teachers) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('general.image')}}</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('teachers.email')}}</th>
                                    <th>{{__('teachers.phone_number1')}}</th>
                                    <th>{{__('general.active')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($teachers as $teacher)
                                <tr>
                                    
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                    <td>
                                        <a class="image-popup-no-margins" href="{{$teacher->profile_picture}}">
                                            <img style = "height: 100px;" src="{{$teacher->profile_picture}}" alt="">
                                        </a>
                                    </td>
                                    <td>{{$teacher->name}}</td>
                                    <td>{{$teacher->email}}</td>
                                    <td>{{$teacher->phone_number1}}</td>
                                    <td>{!! $teacher->active ? '<button class = "btn btn-success  btn-sm"><i class="fas fa-check"></i></button>' : '<button class = "btn btn-danger  btn-sm"><i class="far fa-window-close"></i></button>' !!}</td>
                                 
                                    <td>
                                        <a href = "{{route('dashboard.teacher.edit' , $teacher->id)}}" class = "btn btn-info btn-sm"><i class = "fas fa-edit"></i></a>
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$teacher->id}}"><i class = "fas fa-trash"></i></button>
                                        @include('dashboard.teachers.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$teachers->links()}}
                @else 
                    <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection


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

</script>


@endpush