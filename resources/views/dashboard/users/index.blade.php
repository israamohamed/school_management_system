@extends('dashboard.master')

@section('title' , __('general.users.title'))

@push('styles')

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.users.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.users.title')}}</li>
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
                <select name="role_id" class = "form-control select2"  onchange="this.form.submit()">
                    <option value="">{{__('general.roles.all')}}</option>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{$role->id == request()->role_id ? 'selected' : ''}} >{{$role->name}}</option>
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
                    <h4 class = "float-start">{{__('general.users.title')}} <span class="badge rounded-pill bg-dark">{{$users->total()}}</span> </h4>
                    <a href = "{{route('dashboard.user.create')}}" class="btn btn-primary waves-effect waves-light float-end {{ auth()->user()->can('create.user') ? '' : 'disabled'}}">{{__('general.users.create')}}</a>
                
                    <div class="clearfix"></div>
                </div>

               
                @if(count($users) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('general.name')}}</th>
                                    <th>{{__('general.email')}}</th>
                                    <th>{{__('general.roles.title')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                        
                                            {{-- <button class = "btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$role->id}}"><i class = "fas fa-eye"></i></button> --}}
                                          


                                            <span style = "font-size: 1em;cursor: pointer;" class="badge rounded-pill bg-primary" data-bs-toggle="modal" data-bs-target="#show_modal_{{$role->id}}">
                                                {{$role->display_name}}
                                            </span>
                                            @include('dashboard.roles.show')
                                        @endforeach
                                      
                                        
                                    </td>
                                 
                                    <td>
                                        {{-- <button class = "btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$user->id}}"><i class = "fas fa-eye"></i></button>
                                        @include('dashboard.users.show') --}}

                                        @if($user->name != 'Admin')
                                            <a href = "{{route('dashboard.user.edit' , $user->id)}}" class = "btn btn-info btn-sm {{ auth()->user()->can('edit.user') ? '' : 'disabled'}}"><i class = "fas fa-edit"></i></a>
                                            <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$user->id}}" {{ auth()->user()->can('delete.user') ? '' : 'disabled'}}><i class = "fas fa-trash"></i></button>
                                            @include('dashboard.users.delete')
                                        @endif
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$users->links()}}
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