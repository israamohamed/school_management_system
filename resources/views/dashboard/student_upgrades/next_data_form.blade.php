<div class="card mb-1 shadow-none">
    <a href="#next_stage_form" class="text-dark collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="next_stage_form">
        <div class="card-header" style = "background: none !important ;" id="headingOne">

           
            <button type="submit" class = "btn btn-primary btn-lg" style = "font-size: 1.3em;width: 20%;">
                <i class = "fas fa-arrow-up"></i>  {{__('students.student_upgrades.upgrade')}}
            </button>
        </div>
    </a>

    <div id="next_stage_form" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion">
        <div class="card-body">
           

            <form action = "{{route('dashboard.student_upgrade.store')}}"  method = "post" id = "next_data_form">
                @csrf

                <input type="hidden" name = "previous_educational_stage_id"      value = "{{request()->previous_educational_stage_id}}">
                <input type="hidden" name = "previous_class_room_id"             value = "{{request()->previous_class_room_id}}">
                <input type="hidden" name = "previous_educational_class_room_id" value = "{{request()->previous_educational_class_room_id}}">
                <input type="hidden" name = "previous_academic_year"             value = "{{request()->previous_academic_year}}">
                <input type="hidden" name = "selected_rows">


                <div class="row">
                    <div class="col-md-3 educational_stage_selected_parent">
                        {{-- educational stage --}}
                       <div class="form-group"> 
                           <label for="next_educational_stage_id">{{__('students.student_upgrades.next_educational_stage')}}</label>
                           <select name="next_educational_stage_id" class = "form-control educational_stage_selected select2  @error('next_educational_stage_id') is-invalid @enderror" style = "width: 100%;">
                               <option value="">{{__('general.educational_stages.select')}}</option>
                                   @foreach($educational_stages as $educational_stage)
                                       <option value="{{$educational_stage->id}}" {{$educational_stage->id == request()->next_educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                                   @endforeach
                           </select>
                          
                       </div>
                   </div>
            
                   <div class="col-md-3 class_room_selected_parent">
                       {{-- class room  --}}
                       <div class="form-group">
                           <label for="next_class_room_id">{{__('students.student_upgrades.next_class_room')}}</label>
                           <select name="next_class_room_id"  data-educational_class_room_id = "{{request()->next_educational_class_room_id}}" class = "form-control class_room_selected select2  @error('class_room_id') is-invalid @enderror">
                               
                           </select>
                          
                       </div>                
                   </div>
            
                   <div class="col-md-3">
                       {{-- educational class room  --}}
                       <div class="form-group">
                           <label for="next_educational_class_room_id">{{__('students.student_upgrades.next_educational_class_room')}}</label>
                           <select name="next_educational_class_room_id" class = "form-control educational_class_room_selected select2 @error('next_educational_class_room_id') is-invalid @enderror">
                               
                           </select>
                          
                       </div>                
                   </div>
            
                   <div class="col-md-3">
                        {{-- next academic year  --}}
                        <div class="form-group">
                            <label for="next_academic_year">{{__('students.student_upgrades.next_academic_year')}}</label>
                            <select name="next_academic_year" class = "form-control select2 @error('next_academic_year') is-invalid @enderror">
                                @php
                                    $current_year = date("Y");
                                @endphp
                                @for($year=$current_year + 1; $year>=$current_year ;$year--)
                                    <option value="{{ $year}}" {{request()->next_academic_year == $year ? 'selected' : ''}} >{{ $year }}</option>
                                @endfor
                            </select>              
                        </div>                
                    </div>
            
                </div>
            
                <div class="row m-3">
                    <div class="col-md-12 text-center">
                        <button type="button" id = "save_upgrade_form" class = "btn btn-danger btn-lg" style = "font-size: 1.3em;width: 20%;">
                            <i class = "fas fa-check-double"></i> {{__('general.save')}}
                        </button>
                    </div>
                </div> 
                
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $("#save_upgrade_form").click(function(){

        if($(".select_row:checked").length > 0) {
           
            $("#next_data_form").submit();                 
        }
        else {
            toastr.error("{{__('messages.no_students_selected')}}")
        }

    });
</script>
@endpush
