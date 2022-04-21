@push('scripts')
<script>
    $(".educational_stage_selected").change(function(){
        if($(this).val())
        {
            change_class_rooms(this);
        }
        
    });

    $(".select2_edit_modal").each(function(){

        change_class_rooms(this , $(this).data("class_room_id") );
    });

    
    function change_class_rooms(select , selected_value = null)
    {
        var ele = $(select);
        var educational_stage_id = ele.val();
        var class_form_selected = ele.parent().next().find(".class_room_selected");
        $.ajax({
            method: 'GET',
            url: "{{route('dashboard.get_class_rooms')}}",
            data: {educational_stage_id : educational_stage_id},
            success: function(result) {


                 class_form_selected.empty();
                 var option;
                 var lang = "{{app()->getLocale()}}";
                 var selected;
                
                 result.forEach(function(object){
                     selected = selected_value && selected_value == object.id ? 'selected' : '';

                    option = `<option value = "${object.id}" ${selected}  >${object.name[lang]}</option>`;
                
                    class_form_selected.append(option);
                    //$('.class_room_selected option[value="23"]')
                 });
            }
        });
    }
</script>
@endpush