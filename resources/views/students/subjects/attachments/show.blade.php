   <!--primary theme Modal -->
   <div class="modal fade " id="show_attachment_modal_{{$attachment->id}}" role="dialog" aria-labelledby="show_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header bg-success">
                <h5 class="modal-title white" id="show_modal_label">
                    {{ Str::limit($attachment->description , 30) }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <iframe src="{{$attachment->url}}" frameborder="0" width="100%" height="100%"></iframe>

             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-success waves-effect waves-light">{{__('general.add')}}</button>
            </div>
         
        </div>
    </div>
 </div>

 @push('scripts')
<script>
    /*$(".select2_create_modal").select2({
        dropdownParent: $("#create_modal"),
    });*/
</script>
@endpush