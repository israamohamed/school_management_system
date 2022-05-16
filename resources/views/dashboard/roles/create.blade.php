@extends('dashboard.master')

@section('title' , __('general.roles.create'))

@push('styles')

   
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.roles.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.role.index')}}">{{__('general.roles.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.roles.create')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.roles.create')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('dashboard.role.store')}}" method = "post">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12">
                                {{-- name --}}
                                <div class="form-group">
                                    <label for="name">{{__('general.name')}}</label>
                                    <input type="text" name = "name" class = "form-control @error('name') is-invalid @enderror" value = "{{old('name')}}" placeholder="{{__('general.name')}}">
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
                                {{--display_name ar --}}
                                <div class="form-group">
                                    <label for="display_name_ar">{{__('general.roles.display_name_ar')}}</label>
                                    <input type="text" name = "display_name_ar" class = "form-control @error('display_name_ar') is-invalid @enderror" value = "{{old('display_name_ar')}}" placeholder="{{__('general.roles.display_name_ar')}}">
                                    @error('display_name_ar')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- display_name en --}}
                                <div class="form-group">
                                    <label for="display_name_en">{{__('general.roles.display_name_en')}}</label>
                                    <input type="text" name = "display_name_en" class = "form-control @error('display_name_en') is-invalid @enderror" value = "{{old('display_name_en')}}" placeholder="{{__('general.roles.display_name_en')}}">
                                    @error('display_name_en')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        
                        <div class="row mb-3">
                            <label for="permissions">{{__('general.roles.permissions')}}</label>
                            @error('permissions')
                            <div class="invalid-feedback d-block">
                                {{$message}}
                            </div>
                            @enderror

                            @foreach($permissions as $group)
                                @foreach($group as $permission)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="permission{{$permission->id}}">{{ $permission->display_name }}</label>
                                            
                                            <input type="checkbox" name = "permissions[]" value="{{$permission->id}}" class = "form-check-input" id = "permission{{$permission->id}}" {{old('permissions') && in_array($permission->id , old('permissions') )   ? 'checked' : ''}} >
                                        </div>
                                    </div>
                                @endforeach

                                <hr style = "width: 90%; margin: 10px auto;">
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light float-end">
                            <i class="ri-check-line align-middle me-2"></i>
                            {{__('general.add')}}
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