@extends('dashboard.master')

@section('title' , __('accounts.study_fee_items.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('accounts.study_fee_items.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('accounts.study_fee_items.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('accounts.study_fee_items.title')}}</h4>
                    <button type="button" class="btn btn-primary waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_modal"  {{ auth()->user()->can('create.study_fee_item') ? '' : 'disabled'}}>{{__('general.add')}}</button>
                    @include('dashboard.study_fee_items.create')
                    <div class="clearfix"></div>
                </div>
                @if(count($study_fee_items) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('general.type')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($study_fee_items as $study_fee_item)
                                <tr>
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                    <td>{{$study_fee_item->name}}</td>
                                    <td>{{__('accounts.' . $study_fee_item->type)}}</td>
                                    <td class="text-bold-500">
                                        <button class = "btn btn-info" data-bs-toggle="modal" data-bs-target="#edit_modal_{{$study_fee_item->id}}"  {{ auth()->user()->can('edit.study_fee_item') ? '' : 'disabled'}}><i class = "fas fa-edit"></i></button>
                                        <button class = "btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$study_fee_item->id}}"  {{ auth()->user()->can('delete.study_fee_item') ? '' : 'disabled'}}><i class = "fas fa-trash"></i></button>
 
                                        @include('dashboard.study_fee_items.edit')
                                        @include('dashboard.study_fee_items.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$study_fee_items->links()}}
                @else 
                    <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection