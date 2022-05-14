@push('scripts')
<script>

$(".selected_student").change(function(){
        if($(this).val())
        {
            change_study_fees(this);
        }
});

function change_study_fees(select , selected_value = null)
    {
        var ele = $(select);
        var student_id = ele.val();

        var study_selected = $('.study_fee');
        $.ajax({
            method: 'GET',
            url: "{{route('dashboard.get_student_study_fees')}}",
            data: {student_id : student_id},
            success: function(result) {
                console.log(result);

                 study_selected.empty();
                 var option;
                 var lang = "{{app()->getLocale()}}";
                 var selected;
                
                 option = `<option value = "">{{__('accounts.study_fees.select')}}</option>`;
                 study_selected.append(option);

                 result.forEach(function(object){

                    selected = selected_value && selected_value == object.id ? 'selected' : '';

                    option = `<option value = "${object.id}" ${selected}  data-amount = "${object.amount}" >${object.title[lang]}</option>`;
                
                    study_selected.append(option);

                 });

             

                
            }
        });
    }




function change_study_fees_of_student(student_invoice_id , student_id , selected_value = null)
{
    var study_selected = $("#edit_student_invoice_modal_" + student_invoice_id).find(".study_fee");
    
    $.ajax({
        method: 'GET',
        url: "{{route('dashboard.get_student_study_fees')}}",
        data: {student_id : student_id},
        success: function(result) {
                console.log(result);
                study_selected.empty();
                var option;
                var lang = "{{app()->getLocale()}}";
                var selected;
            
                option = `<option value = "">{{__('accounts.study_fees.select')}}</option>`;
                study_selected.append(option);

                result.forEach(function(object){

                selected = selected_value && selected_value == object.id ? 'selected' : '';

                option = `<option value = "${object.id}" ${selected}  data-amount = "${object.amount}" >${object.title[lang]}</option>`;
            
                study_selected.append(option);

                });

            

            
        }
    });
}

</script>
@endpush