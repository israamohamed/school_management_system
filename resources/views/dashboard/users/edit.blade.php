@extends('dashboard.master')

@section('title' , $user->name)

@push('styles')

   
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{$user->name}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.user.index')}}">{{__('general.users.title')}}</a></li>
            <li class="breadcrumb-item active">{{$user->name}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{$user->name}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('dashboard.user.update' , $user->id)}}" method = "post">
                        @csrf
                        @method('put')

                        <div class="row mb-3">
                            <div class="col-md-12">
                                {{-- name --}}
                                <div class="form-group">
                                    <label for="name">{{__('general.name')}}</label>
                                    <input type="text" name = "name" class = "form-control @error('name') is-invalid @enderror" value = "{{$user->name}}" placeholder="{{__('general.name')}}">
                                    @error('name')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--email  --}}
                                <div class="form-group">
                                    <label for="email">{{__('general.email')}}</label>
                                    <input type="email" name = "email" class = "form-control @error('email') is-invalid @enderror" value = "{{$user->email}}" placeholder="{{__('general.email')}}">
                                    @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- password  --}}
                                <div class="form-group">
                                    <label for="password">{{__('general.password')}}</label>
                                    <input type="password" name = "password" class = "form-control @error('password') is-invalid @enderror" placeholder="{{__('general.password')}}">
                                    @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{-- roles  --}}
                                <div class="form-group">
                                    <label for="roles">{{__('general.roles.title')}}</label>

                                    <select name="roles[]" class = "form-control select2 @error('roles') is-invalid @enderror" multiple>
                                        <option value="">{{__('general.roles.select')}}</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}" {{ $user->roles &&  in_array( $role->id , $user->roles->pluck('id')->toArray()) ? 'selected' : ''}} >{{$role->name}}</option>
                                        @endforeach       
                                    </select>
                                    @error('roles')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                        </div>

                        <input type="hidden" name = "id" value = "{{$user->id}}">

                        <button type="submit" class="btn btn-info btn-lg waves-effect waves-light float-end">
                            <i class="ri-check-line align-middle me-2"></i>
                            {{__('general.edit')}}
                        </button>

                    </form>
                    
                </div>
             

            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
    
    <script>
         $(document).ready(function() {

            $(".select2").select2();
    });

        
    </script>

@endpush