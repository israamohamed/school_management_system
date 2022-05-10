   <!--primary theme Modal -->
   <div class="modal fade " id="edit_attachment_modal_{{$attachment->id}}" role="dialog" aria-labelledby="edit_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white" id="edit_modal_label">
                    {{__('general.attachments.edit')}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('teacher.subject.update_attachment' , $attachment->id)}}" method = "post">
                 @csrf
                 @method('put')

                 {{-- Description --}}
                 <div class="form-group mb-2">
                    <label for="description">{{__('general.attachments.description')}}</label>
                    <textarea type="text" name = "description" class = "form-control">{{$attachment->description}}</textarea>
                </div> 
 
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-info waves-effect waves-light">{{__('general.edit')}}</button>
            </div>
         </form>
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