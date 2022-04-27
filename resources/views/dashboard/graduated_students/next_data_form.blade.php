<div class="card mb-1 shadow-none">
    <a href="#next_stage_form" class="text-dark collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="next_stage_form">
        <div class="card-header" style = "background: none !important ;" id="headingOne">

           
            <button type="submit" class = "btn btn-primary btn-lg" style = "font-size: 1.3em;width: 20%;">
                <i class = "fas fa-graduation-cap"></i>  {{__('students.graduated_students.graduate')}}
            </button>
        </div>
    </a>

    <div id="next_stage_form" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion">
        <div class="card-body">
           

            <form action = "{{route('dashboard.graduated_student.store')}}"  method = "post" id = "next_data_form">
                @csrf

                <input type="hidden" name = "previous_educational_stage_id"      value = "{{request()->previous_educational_stage_id}}">
                <input type="hidden" name = "previous_class_room_id"             value = "{{request()->previous_class_room_id}}">
                <input type="hidden" name = "previous_educational_class_room_id" value = "{{request()->previous_educational_class_room_id}}">
                <input type="hidden" name = "previous_academic_year"             value = "{{request()->previous_academic_year}}">
                <input type="hidden" name = "selected_rows">


             
            
                <div class="row m-3">
                    <div class="col-md-12 text-center">
                        <button type="button" id = "save_gradute_form" class = "btn btn-danger btn-lg" style = "font-size: 1.3em;width: 20%;">
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
    $("#save_gradute_form").click(function(){

        if($(".select_row:checked").length > 0) {
           
            $("#next_data_form").submit();                 
        }
        else {
            toastr.error("{{__('messages.no_students_selected')}}")
        }

    });
</script>
@endpush
