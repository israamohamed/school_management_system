@extends('dashboard.master')

@section('title' , __('accounts.study_fees.edit'))

@push('styles')

   
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('accounts.study_fees.edit')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.study_fee.index')}}">{{__('accounts.study_fees.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('accounts.study_fees.edit')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('accounts.study_fees.edit')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('dashboard.study_fee.update' , $study_fee->id)}}" method = "post">
                        @csrf
                        @method('put')
                      

                        <div class="row mb-3">
                            <div class="col-md-6">
                                {{--title ar --}}
                                <div class="form-group">
                                    <label for="title_ar">{{__('general.title_ar')}}</label>
                                    <input type="text" name = "title_ar" class = "form-control @error('title_ar') is-invalid @enderror" value = "{{$study_fee->getTranslation('title' , 'ar')}}" placeholder="{{__('general.title_ar')}}">
                                    @error('title_ar')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                            <div class="col-md-6">
                                {{-- title en --}}
                                <div class="form-group">
                                    <label for="title_en">{{__('general.title_en')}}</label>
                                    <input type="text" name = "title_en" class = "form-control @error('title_en') is-invalid @enderror" value = "{{$study_fee->getTranslation('title' , 'en')}}" placeholder="{{__('general.title_en')}}">
                                    @error('title_en')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-3">

                            <div class="col-md-6">
                                {{-- description ar --}}
                                <div class="form-group">
                                    <label for="description_ar">{{__('general.description_ar')}}</label>
                                    <input type="text" name = "description_ar" class = "form-control @error('description_ar') is-invalid @enderror" value = "{{$study_fee->getTranslation('description' , 'ar')}}" placeholder="{{__('general.description_ar')}}">
                                    @error('description_ar')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                {{--description_en --}}
                                <div class="form-group">
                                    <label for="description_en">{{__('general.description_en')}}</label>
                                    <input type="text" name = "description_en" class = "form-control @error('description_en') is-invalid @enderror" value = "{{$study_fee->getTranslation('description' , 'en')}}" placeholder="{{__('general.description_en')}}">
                                    @error('description_en')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>
                           
                        </div>


                     

                        <div class="row mb-3">

                            <div class="col-md-3">
                                {{-- study fee item  --}}
                                <div class="form-group">
                                    <label for="study_fee_item_id">{{__('accounts.study_fee_items.one')}}</label>
                                    <select name="study_fee_item_id" class = "form-control select2 @error('study_fee_item_id') is-invalid @enderror">
                                        <option value="">{{__('accounts.study_fee_items.select')}}</option>
                                        @foreach($study_fee_items as $study_fee_item)
                                            <option value="{{$study_fee_item->id}}" {{$study_fee->study_fee_item_id == $study_fee_item->id ? 'selected' : ''}} >{{$study_fee_item->name}}</option>
                                        @endforeach       
                                    </select>
                                    @error('study_fee_item_id')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>        
                            </div>

                            <div class="col-md-3">
                                {{-- academic year  --}}
                                <div class="form-group">
                                    <label for="academic_year">{{__('general.academic_year')}}</label>
                                    <select name="academic_year" class = "form-control select2 @error('academic_year') is-invalid @enderror">
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year + 1; $year>=$current_year ;$year--)
                                            <option value="{{ $year}}" {{$study_fee->academic_year == $year ? 'selected' : ''}} >{{ $year }}</option>
                                        @endfor
                                    </select>              
                                </div>                
                            </div>

                            <div class="col-md-3 educational_stage_selected_parent">
                                {{-- educational stage --}}
                               <div class="form-group"> 
                                   <label for="educational_stage_id">{{__('general.educational_stages.one')}}</label>
                                   <select name="educational_stage_id" class = "form-control educational_stage_selected select2  @error('educational_stage_id') is-invalid @enderror" style = "width: 100%;">
                                       <option value="">{{__('general.educational_stages.one')}}</option>
                                           @foreach($educational_stages as $educational_stage)
                                               <option value="{{$educational_stage->id}}" {{$educational_stage->id == $study_fee->educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                                           @endforeach
                                   </select>
                                   @error('educational_stage_id')
                                   <div class="invalid-feedback d-block">
                                       {{$message}}
                                   </div>
                                   @enderror
                               </div>
                           </div>

                           <div class="col-md-3 class_room_selected_parent">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">{{__('general.amount')}} <i class = " fas fa-money-bill-wave"></i> </label>
                                    <input type="number" name = "amount" class = "form-control @error('amount') is-invalid @enderror" value = "{{$study_fee->amount}}" placeholder="{{__('general.amount')}}">
                                    @error('amount')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light float-end">
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

@include('dashboard.scripts.change_educatioanl_data')

@push('scripts')
    
    <script>
         $(document).ready(function() {

            $(".select2").select2();
    });
        
    </script>

    <script>
        change_class_rooms( $(".educational_stage_selected") ,  "{{$study_fee->class_room_id}}"  );

    </script>

@endpush