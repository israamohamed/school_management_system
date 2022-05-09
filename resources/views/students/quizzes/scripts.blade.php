@push('scripts')
<script>
    $(".start_quiz_btn").click(function(){

        var warning = "{{__('messages.start_quiz_warning' , ['name' => ':name' ])}}";
        warning = warning.replace(":name" , $(this).data("quiz_name")  );

        var quiz_id = $(this).data("quiz_id");
    
        Swal.fire({
            title: "{{__('messages.are_you_sure')}}",
            text:  warning,
            icon: 'info',
            showCancelButton: true,
            //confirmButtonColor: '#006298',
            confirmButtonColor : 'd33',
            cancelButtonColor: '#898989',
            confirmButtonText: "{{__('quizzes.start_quiz')}}"
        }).then((result) => {
                if (result.isConfirmed) {
                    $("#start_quiz_form_" + quiz_id).submit();
                }
        })
      

        });
</script>
@endpush