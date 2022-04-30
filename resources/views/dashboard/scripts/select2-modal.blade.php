@push('scripts')
<script>
        $(".select2-modal").each(function(){
            var parent = $(this).closest(".modal")
            $(this).select2({
                dropdownParent: parent
            });

        });
</script>
@endpush