@extends('dashboard.master')

@section('title' , __('general.roles.title'))

@push('styles')

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.roles.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.roles.title')}}</li>
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
        </div>
    </form>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.roles.title')}} <span class="badge rounded-pill bg-dark">{{$roles->total()}}</span> </h4>
                    <a href = "{{route('dashboard.role.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('general.roles.create')}}</a>
                
                    <div class="clearfix"></div>
                </div>

               
                @if(count($roles) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('general.roles.display_name')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        <span style = "font-size: 1em;" class="badge rounded-pill bg-primary">{{$role->display_name}}</span>
                                        
                                    </td>
                                 
                                    <td>
                                        <button class = "btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$role->id}}"><i class = "fas fa-eye"></i></button>
                                        @include('dashboard.roles.show')

                                        <a href = "{{route('dashboard.role.edit' , $role->id)}}" class = "btn btn-info btn-sm"><i class = "fas fa-edit"></i></a>
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$role->id}}"><i class = "fas fa-trash"></i></button>
                                        @include('dashboard.roles.delete')
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$roles->links()}}
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


<script>
    $(".select2").each(function(ele){
        var placeholder = $(this).attr("placeholder");

        $(this).select2({
            placeholder:  placeholder,
        });
    });
  
</script>

@endpush