@extends('teachers.master')

@section('title' , __('quizzes.title'))

@push('styles')

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('quizzes.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('teacher.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('quizzes.title')}}</li>
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
                    <h4 class = "float-start">{{__('quizzes.title')}} <span class="badge rounded-pill bg-dark">{{$quizzes->total()}}</span> </h4>
                    <a href = "{{route('teacher.quiz.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('quizzes.create')}}</a>
                
                    <div class="clearfix"></div>
                </div>

               
                @if(count($quizzes) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                  
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('general.subjects.title')}}</th>
                                    <th>{{__('general.educational_class_rooms.title')}}</th>
                                    <th>{{__('quizzes.time_in_minutes')}}</th>
                                    <th>{{__('general.active')}}</th>
                                    <th>{{__('quizzes.status')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($quizzes as $quiz)
                                <tr>        
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                   
                                    <td>{{$quiz->name}}</td>
                                    <td>{{$quiz->subject ? $quiz->subject->name : '' }}</td>
                                    <td>{{$quiz->educational_class_room ? $quiz->educational_class_room->name : '' }}</td>
                                    <td>{{$quiz->time_in_minutes}}</td>
                                    <td>{!! $quiz->active ? '<button class = "btn btn-success  btn-sm"><i class="fas fa-check"></i></button>' : '<button class = "btn btn-danger  btn-sm"><i class="far fa-window-close"></i></button>' !!}</td>
                                    <td><span style = "font-size:1em;" class = "badge rounded-pill bg-{{$quiz->status_color}}">{{__('quizzes.' . $quiz->status)}}</span></td>
                                    <td>
                                        <a href = "{{route('teacher.quiz.edit' , $quiz->id)}}" class = "btn btn-info btn-sm"><i class = "fas fa-edit"></i></a>
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$quiz->id}}"><i class = "fas fa-trash"></i></button>
                                        @include('teachers.quizzes.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$quizzes->links()}}
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
    $(".select2").each(function(ele){
        var placeholder = $(this).attr("placeholder");

        $(this).select2({
            placeholder:  placeholder,
        });
    });

</script>
@endpush