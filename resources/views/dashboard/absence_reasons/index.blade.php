@extends('dashboard.master')

@section('title' , __('general.absence_reasons.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.absence_reasons.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.absence_reasons.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.absence_reasons.title')}}</h4>
                    <button type="button" class="btn btn-primary waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_modal" {{ auth()->user()->can('create.absence_reason') ? '' : 'disabled'}}>{{__('general.add')}}</button>
                    @include('dashboard.absence_reasons.create')
                    <div class="clearfix"></div>
                </div>
                @if(count($absence_reasons) > 0)
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
                                @foreach($absence_reasons as $absence_reason)
                                <tr>
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                    <td>{{$absence_reason->name}}</td>
                                    <td class="text-bold-500">
                                        <button class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#edit_modal_{{$absence_reason->id}}" {{ auth()->user()->can('edit.absence_reason') ? '' : 'disabled'}}><i class = "fas fa-edit"></i></button>
                                        <button class = "btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$absence_reason->id}}" {{ auth()->user()->can('delete.absence_reason') ? '' : 'disabled'}}><i class = "fas fa-trash"></i></button>
 
                                        @include('dashboard.absence_reasons.edit')
                                        @include('dashboard.absence_reasons.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$absence_reasons->links()}}
                @else 
                    <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection