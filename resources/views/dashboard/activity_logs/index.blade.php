@extends('dashboard.master')

@section('title' , __('activity_logs.title'))

@push('styles')

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('activity_logs.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('activity_logs.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

{{-- Filters --}}
<div style = "margin: 10px 0;">
    <form method = "GET">
        <div class="row">
            <div class="col-md-3">
                <label for="created_at">{{__('general.created_at')}}</label>
                <input type="date" name = "created_at" class = "form-control" value = "{{request()->created_at}}" onchange="this.form.submit()">
            </div>

            

            <div class="col-md-3">
                <label for="log_name">{{__('activity_logs.the_subject')}}</label>
                <select name="log_name" class = "form-control select2"  onchange="this.form.submit()">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($subjects as $key => $subject)
                            <option value="{{$key}}" {{$key == request()->log_name ? 'selected' : ''}} >{{$subject}}</option>
                        @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="user_id">{{__('general.users.one')}}</label>
            
                    <select name="user_id" class = "form-control select2"  onchange="this.form.submit()">
                        <option value="">{{__('general.all')}}</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" {{$user->id == request()->user_id ? 'selected' : ''}} >{{$user->name}}</option>
                            @endforeach
                    </select>
            </div>

            <div class="col-md-3">
                <label for="teacher_id">{{__('teachers.one')}}</label>
            
                    <select name="teacher_id" class = "form-control select2"  onchange="this.form.submit()">
                        <option value="">{{__('general.all')}}</option>
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}" {{$teacher->id == request()->teacher_id ? 'selected' : ''}} >{{$teacher->name}}</option>
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
                    <h4 class = "float-start">{{__('activity_logs.title')}} <span class="badge rounded-pill bg-dark">{{$activity_logs->total()}}</span> </h4>
                
                    <div class="clearfix"></div>
                </div>

               
                @if(count($activity_logs) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('general.created_at')}}</th>
                                    <th>{{__('general.description')}}</th>
                                    <th>{{__('general.created_by')}}</th>
                                    <th>{{__('general.notes')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($activity_logs as $log)
                                <tr>
                                    
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                    <td>{{$log->created_at}}</td>
                                    <td>{{$log->description}}</td>
                                    <td>{{$log->causer ? $log->causer->name : '' }} </td>
                                    <td class = "col-md-4">
                                        @if( isset($log->changes['attributes']) )
                                            @foreach($log->changes['attributes'] as $key =>  $attribute)
                                                <span style = "font-size: 0.9em;" class = "badge bg-primary">{{ $attribute }}</span>
                                            @endforeach
                                        @endif
                                        <br>
                                        @if( isset($log->changes['old']) )
                                        @foreach($log->changes['old'] as $attribute)
                                            <span style = "font-size: 0.9em;" class = "badge bg-danger">{{ $attribute }}</span>
                                        @endforeach
                                    @endif
                                       
                                    </td>
                                 
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$log->id}}"><i class = " far fa-eye"></i> </button>
                                        @include('dashboard.activity_logs.show_modal')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$activity_logs->links()}}
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