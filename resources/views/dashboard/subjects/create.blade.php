@extends('dashboard.master')

@section('title' , __('general.subjects.create'))

@push('styles')
<style>

</style>
   
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('general.subjects.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.subject.index')}}">{{__('general.subjects.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('general.subjects.create')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('general.subjects.create')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('dashboard.subject.store')}}" method = "post">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--name ar --}}
                                <div class="form-group">
                                    <label for="name_ar">{{__('general.name_ar')}}</label>
                                    <input type="text" name = "name_ar" class = "form-control @error('name_ar') is-invalid @enderror" value = "{{old('name_ar')}}" placeholder="{{__('general.name_ar')}}">
                                    @error('name_ar')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- name en --}}
                                <div class="form-group">
                                    <label for="name_en">{{__('general.name_en')}}</label>
                                    <input type="text" name = "name_en" class = "form-control @error('name_en') is-invalid @enderror" value = "{{old('name_en')}}" placeholder="{{__('general.name_en')}}">
                                    @error('name_en')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            {{-- educational stage --}}
                            <div class="col-md-6 educational_stage_selected_parent">
                                {{-- educational stage --}}
                               <div class="form-group"> 
                                   <label for="educational_stage_id">{{__('general.educational_stages.one')}}</label>
                                   <select name="educational_stage_id" class = "form-control educational_stage_selected select2  @error('educational_stage_id') is-invalid @enderror" style = "width: 100%;">
                                       <option value="">{{__('general.educational_stages.one')}}</option>
                                           @foreach($educational_stages as $educational_stage)
                                               <option value="{{$educational_stage->id}}" {{$educational_stage->id == old('educational_stage_id') ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                                           @endforeach
                                   </select>
                                   @error('educational_stage_id')
                                   <div class="invalid-feedback d-block">
                                       {{$message}}
                                   </div>
                                   @enderror
                               </div>
                           </div>
                           {{-- class room --}}
                           <div class="col-md-6 class_room_selected_parent">
                               {{-- class room  --}}
                               <div class="form-group">
                                   <label for="class_room_id">{{__('general.class_rooms.one')}}</label>
                                   <select name="class_room_id" class = "form-control class_room_selected select2  @error('class_room_id') is-invalid @enderror">
                                       
                                   </select>
                                   @error('class_room_id')
                                   <div class="invalid-feedback d-block">
                                       {{$message}}
                                   </div>
                                   @enderror
                               </div>                
                           </div>
                        </div>

                        <div class="row mb-3">
                            {{-- upper grade --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="upper_grade">{{__('general.subjects.upper_grade')}} <i class = "fas fa-arrow-alt-circle-up"></i> </label>
                                    <input type="number" name = "upper_grade" class = "form-control @error('upper_grade') is-invalid @enderror" value = "{{old('upper_grade')}}" placeholder="{{__('general.subjects.upper_grade')}}">
                                    @error('upper_grade')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- lower grade --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lower_grade">{{__('general.subjects.lower_grade')}} <i class = "fas fa-arrow-circle-down"></i> </label>
                                    <input type="number" name = "lower_grade" class = "form-control @error('lower_grade') is-invalid @enderror" value = "{{old('lower_grade')}}" placeholder="{{__('general.subjects.lower_grade')}}">
                                    @error('lower_grade')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <h5 class = "text-info">{{__('general.subjects.attributes')}}</h5>

                        <div class="row mb-3">
                            {{-- main subject --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="main_subject">{{__('general.subjects.main_subject')}}</label>
                                    <input type="checkbox" name = "main_subject" class = "form-control form-check-input" id = "main_subject" {{old('main_subject') ? 'checked' : ''}} >
                                </div>
                            </div>
                            {{-- success_required --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="success_required">{{__('general.subjects.success_required')}}</label>
                                    <input type="checkbox" name = "success_required" class = "form-control form-check-input" id = "success_required" {{old('success_required') ? 'checked' : ''}} >
                                </div>
                            </div>

                            {{-- shared_between_terms --}}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="shared_between_terms">{{__('general.subjects.shared_between_terms')}}</label>
                                    <input type="checkbox" name = "shared_between_terms" id = "shared_between_terms_checkbox" class = "form-control form-check-input" id = "shared_between_terms" {{old('shared_between_terms') ? 'checked' : ''}} >
                                </div>
                            </div>

                            {{-- shared_between_terms --}}
                            <div class="col-md-3" id = "term_select_parent" style = "visibility :   {{old('shared_between_terms') ? 'hidden' : 'visible' }} " >
                                <div class="form-group">
                                    <label for="shared_between_terms">{{__('general.subjects.term')}}</label>
                                    <select name="term" id = "term_select" class = "form-control select2">
                                        <option value="">{{__('general.subjects.term')}}</option>
                                        <option value="first" {{old('term') == 'first' ? 'selected' : ''}} >{{__('general.subjects.first_term')}}</option>
                                        <option value="second" {{old('term') == 'second' ? 'selected' : ''}}>{{__('general.subjects.second_term')}}</option>

                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            {{-- Active --}}                
                            <div class="form-group">
                                <label for="active">{{__('general.active')}}</label>
                                <input type="checkbox" name = "active" class = "form-check-input" id = "active" {{old('active') ? 'checked' : ''}} >
                            </div>
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

@include('dashboard.scripts.change_educatioanl_data')

@push('scripts')
@if(old('educational_stage_id'))
    <script>
        change_class_rooms($("select[name='educational_stage_id']") , "{{old('class_room_id')}}"  );
    </script>
@endif
@endpush

@push('scripts')
    
    <script>
         $(document).ready(function() {

            $(".select2").select2();
    });

        
    </script>

    <script>
         $("#shared_between_terms_checkbox").click(function(){
        var checked = $(this).is(':checked');
        if(checked)
        {
            $("#term_select_parent").css("visibility" , "hidden");
        }
        else 
        {
            $("#term_select_parent").css("visibility" , "visible");
        }
    })  
    </script>

    

@endpush