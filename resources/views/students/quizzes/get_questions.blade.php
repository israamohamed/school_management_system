@extends('students.master')

@section('title' , $quiz->name )

@push('styles')
    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="{{asset('dashboard/assets/libs/twitter-bootstrap-wizard/prettify.css')}}">
@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{ $quiz->name }}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('student.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{ $quiz->name }}</li>
        </ol>
    </div>
@endsection

@section('content')

<form action="{{route('student.quiz.solve_quiz' , $quiz->id)}}" method = "post">
    @csrf
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3">
                        {{-- <h4 class = "float-start">{{$quiz->name}} <span class="badge rounded-pill bg-dark"></span> </h4> --}}
                    
                        <div class="clearfix"></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class = "text-center text-danger">
                                <span id = "minutes">{{$quiz->time_in_minutes}}</span> :
                                <span id = "seconds">00</span>
                            </h2>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4"></h4>
                                    

                                    <div id="progrss-wizard" class="twitter-bs-wizard">
                                        <ul class="twitter-bs-wizard-nav nav-justified">

                                            @foreach($questions as $question)
                                            <li class="nav-item">
                                                <a href="#question{{$question->id}}" class="nav-link" data-toggle="tab">
                                                    <span class="step-number">{{$loop->iteration}}</span>
                                                    <span class="step-title"></span>
                                                </a>
                                            </li>
                                            @endforeach

                                            {{-- submit li --}}
                                            <li class="nav-item">
                                                <a href="#send_questions" class="nav-link" data-toggle="tab">
                                                    <span class="step-number"></span>
                                                    <span class="step-title"></span>
                                                </a>
                                            </li>
                                        
                                        </ul>

                                        <div id="bar" class="progress mt-4">
                                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated"></div>
                                        </div>
                                        <div class="tab-content twitter-bs-wizard-tab-content">
    
                                                @foreach($questions as $question)
                                                <div class="tab-pane" id="question{{$question->id}}">
                                                <h3 class = "text-center text-primary mb-5">{{$question->title}}</h3>
                                                <div class="row justify-content-center">
                                                    @foreach($question->choices as $choice)
                                                    <div class="col-md-6 text-center">
                                                            <div class="form-check text-center mb-3 py-3 bg-secondary rounded" style = "font-size: 1.7em;font-weight:bold;">
                                                                {{-- <div class = "text-center"> --}}
                                                                    <input class="form-check-input mx-2" type="radio" name="choices[{{$question->id}}]" value = "{{$choice->id}}" id="choice{{$choice->id}}">
                                                                    <label class="form-check-label" for="choice{{$choice->id}}" style = "color:white;">{{$choice->title}}</label>
                                                                {{-- </div> --}}

                                                            </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                </div>
                                                @endforeach

                                                {{-- send questions tab --}}
                                                <div class="tab-pane" id="send_questions">
                                                    <div class="row justify-content-center">
                                                        <div class="col-lg-6">
                                                            <div class="text-center">
                                                                <div class="mb-4">
                                                                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                                </div>
                                                                <div>
                                                                    <h5>{{__('quizzes.submit_answers')}}</h5>
                                                                    <p class="text-muted">{{__('messages.submit_answers_warning')}}</p>

                                                                    <input type="submit" class = "btn btn-success" value = "{{__('quizzes.submit_answers')}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        
                                        
                                        </div>
                                        <ul class="pager wizard twitter-bs-wizard-pager-link">
                                            <li class="previous"><a href="javascript: void(0);">{{__('general.previous')}}</a></li>
                                            <li class="next"><a href="javascript: void(0);">{{__('general.next')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@include('students.quizzes.scripts')

@push('scripts')
<script>
    $(".select2").each(function(ele){
        var placeholder = $(this).attr("placeholder");

        $(this).select2({
            placeholder:  placeholder,
        });
    });

</script>

<!-- twitter-bootstrap-wizard js -->
<script src="{{asset('dashboard/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

<script src="{{asset('dashboard/assets/libs/twitter-bootstrap-wizard/prettify.js')}}"></script>

<!-- form wizard init -->
<script src="{{asset('dashboard/assets/js/pages/form-wizard.init.js')}}"></script>
@endpush