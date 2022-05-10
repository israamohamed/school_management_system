   <!--primary theme Modal -->
   <div class="modal fade " id="create_attachment_modal" role="dialog" aria-labelledby="create_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title white" id="create_modal_label">
                    {{__('general.attachments.create')}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('teacher.subject.store_attachments' , $subject->id)}}" method = "post" enctype="multipart/form-data">
                 @csrf

                 {{-- Description --}}
                 <div class="form-group mb-2">
                    <label for="description">{{__('general.attachments.description')}}</label>
                    <textarea type="text" name = "description" class = "form-control"></textarea>
                </div>


                 {{--Attachments--}}
                 <div class="form-group mb-2">
                     <label for="attachments">{{__('general.attachments.title')}}</label>
                     <input type="file" name = "attachments[]" class = "form-control" multiple>
                 </div>
 
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-success waves-effect waves-light">{{__('general.add')}}</button>
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