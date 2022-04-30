@push('scripts')
<script>

    function changing_amount(select)
    {
        var amount = $(select).find(':selected').data('amount');
        console.log($(select).closest(".study_fee_parent").next().find('.total').val(amount));
    }

</script>
@endpush