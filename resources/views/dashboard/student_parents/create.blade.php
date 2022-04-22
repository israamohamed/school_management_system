@extends('dashboard.master')

@section('title' , __('student_parents.title'))

@push('styles')
    <!-- twitter-bootstrap-wizard css -->
    <link rel="stylesheet" href="{{asset('dashboard/assets/libs/twitter-bootstrap-wizard/prettify.css')}}">
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('student_parents.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.student_parent.index')}}">{{__('student_parents.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('student_parents.create')}}</li>
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
                    <h4 class = "float-start">{{__('student_parents.create')}}</h4>
                    
                    @livewire('add-parent')
                </div>
             

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

    <!-- form wizard -->
    <script src="{{asset('dashboard/assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="{{asset('dashboard/assets/libs/twitter-bootstrap-wizard/prettify.js')}}"></script>
    <script src="{{asset('dashboard/assets/js/pages/form-wizard.init.js')}}"></script>

    <script>
        $(".select2").select2();
    </script>

@endpush