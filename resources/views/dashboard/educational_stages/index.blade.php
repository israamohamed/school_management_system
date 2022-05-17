@extends('dashboard.master')

@section('title' , __('general.educational_stages.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.educational_stages.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.educational_stages.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.educational_stages.title')}}</h4>
                    <button type="button" class="btn btn-primary waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_modal" {{ auth()->user()->can('create.educational_stage') ? '' : 'disabled'}} >{{__('general.add')}}</button>
                    @include('dashboard.educational_stages.create')
                    <div class="clearfix"></div>
                </div>
                @if(count($educational_stages) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($educational_stages as $educational_stage)
                                <tr>
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                    <td>{{$educational_stage->name}}</td>
                                    <td class="text-bold-500">
                                        <button class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#edit_modal_{{$educational_stage->id}}" {{ auth()->user()->can('edit.educational_stage') ? '' : 'disabled'}}>{{__('general.edit')}}</button>
                                        <button class = "btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$educational_stage->id}}" {{ auth()->user()->can('delete.educational_stage') ? '' : 'disabled'}}>{{__('general.delete')}}</button>
                                        {{-- <button class = "btn btn-danger delete-btn" data-educational_stage_id = "{{$educational_stage->id}}" >{{__('general.delete')}}</button> --}}
                                        @include('dashboard.educational_stages.edit')
                                        @include('dashboard.educational_stages.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$educational_stages->links()}}
                @else 
                    <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection