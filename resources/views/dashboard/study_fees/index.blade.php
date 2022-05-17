@extends('dashboard.master')

@section('title' , __('accounts.study_fees.title'))

@push('styles')
    <!-- Lightbox css -->
    <link href="{{asset('dashboard/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('accounts.study_fees.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('accounts.study_fees.title')}}</li>
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
                <select name="study_fee_item_id" class = "form-control select2"  onchange="this.form.submit()" placeholder="{{__('accounts.study_fee_items.one')}}">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($study_fee_items as $study_fee_item)
                            <option value="{{$study_fee_item->id}}" {{$study_fee_item->id == request()->study_fee_item_id ? 'selected' : ''}} >{{$study_fee_item->name}}</option>
                        @endforeach
                </select>
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
                    <h4 class = "float-start">{{__('accounts.study_fees.title')}} <span class="badge rounded-pill bg-dark">{{$study_fees->total()}}</span> </h4>
                    <a href = "{{route('dashboard.study_fee.create')}}" class="btn btn-primary waves-effect waves-light float-end  {{ auth()->user()->can('create.study_fee') ? '' : 'disabled'}}">{{__('accounts.study_fees.create')}}</a>
                
                    <div class="clearfix"></div>
                </div>

               
                @if(count($study_fees) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('general.title')}}</th>
                                    <th>{{__('accounts.study_fee_items.one')}}</th>
                                    <th>{{__('general.academic_year')}}</th>
                                    <th>{{__('general.educational_stages.one')}}</th>
                                    <th>{{__('general.class_rooms.one')}}</th>
                                   <th>{{__('general.amount')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($study_fees as $study_fee)
                                <tr>
                                    
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                 
                                    <td>{{$study_fee->title}}</td>
                                    <td>{{$study_fee->study_fee_item ? $study_fee->study_fee_item->name : '--'}}</td>
                                    <td>{{$study_fee->academic_year}}</td>
                                    <td>{{$study_fee->educational_stage ? $study_fee->educational_stage->name : '--' }}</td>
                                
                                    <td>{{$study_fee->class_room ? $study_fee->class_room->name : '--'}}</td>
                                    <td>{{$study_fee->amount}}</td>

                                    <td>
                                        <a href = "{{route('dashboard.study_fee.edit' , $study_fee->id)}}" class = "btn btn-info btn-sm {{ auth()->user()->can('edit.study_fee') ? '' : 'disabled'}}"><i class = "fas fa-edit"></i></a>
                                        <button class = "btn btn-danger btn-sm {{ auth()->user()->can('delete.study_fee') ? '' : 'disabled'}}" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$study_fee->id}}"><i class = "fas fa-trash"></i></button>
                                        @include('dashboard.study_fees.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$study_fees->links()}}
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

@endpush