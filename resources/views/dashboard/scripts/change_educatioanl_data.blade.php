@push('scripts')
<script>
    $(".educational_stage_selected").change(function(){
        if($(this).val())
        {
            change_class_rooms(this);
        }
    });

    $(".class_room_selected").change(function(){
        if($(this).val())
        {
            change_educational_class_rooms(this);
        }
    });

    $(".select2_edit_modal").each(function(){

        change_class_rooms(this , $(this).data("class_room_id") );
    });

    
    function change_class_rooms(select , selected_value = null)
    {
        var ele = $(select);
        var educational_stage_id = ele.val();
        //var class_form_selected = ele.parent().next().find(".class_room_selected");
        var class_form_selected = ele.closest('.educational_stage_selected_parent').next().find(".class_room_selected");
        $.ajax({
            method: 'GET',
            url: "{{route('dashboard.get_class_rooms')}}",
            data: {educational_stage_id : educational_stage_id},
            success: function(result) {

                 class_form_selected.empty();
                 var option;
                 var lang = "{{app()->getLocale()}}";
                 var selected;
                
                 option = `<option value = "">{{__('general.class_rooms.select')}}</option>`;
                 class_form_selected.append(option);

                 result.forEach(function(object){

                    selected = selected_value && selected_value == object.id ? 'selected' : '';

                    option = `<option value = "${object.id}" ${selected}  >${object.name[lang]}</option>`;
                
                    class_form_selected.append(option);

                 });

                if(selected_value) 
                {
                    change_educational_class_rooms(class_form_selected , class_form_selected.data("educational_class_room_id"));
                }

                
            }
        });
    }



    function change_educational_class_rooms(select , selected_value = null)
    {
        var ele = $(select);
        var class_room_id = ele.val();
        var educational_class_room_form = ele.closest('.class_room_selected_parent').next().find(".educational_class_room_selected");
        $.ajax({
            method: 'GET',
            url: "{{route('dashboard.get_educational_class_rooms')}}",
            data: {class_room_id : class_room_id},
            success: function(result) {

                 educational_class_room_form.empty();
                 var option;
                 var lang = "{{app()->getLocale()}}";
                 var selected;
                
                 option = `<option value = "">{{__('general.educational_class_rooms.select')}}</option>`;
                 educational_class_room_form.append(option);

                 result.forEach(function(object){

                    selected = selected_value && selected_value == object.id ? 'selected' : '';

                    option = `<option value = "${object.id}" ${selected} >${object.name[lang]}</option>`;
                
                    educational_class_room_form.append(option);

                 });
            }
        });
    }
</script>
@endpush