   <!--primary theme Modal -->
   <div class="modal fade" id="edit_modal_{{$educational_stage->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$educational_stage->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.educational_stage.update' , $educational_stage->id)}}" method = "post">
                    @csrf
                    @method('put')
                    {{--name ar --}}
                    <div class="form-group">
                        <label for="name_ar">{{__('general.name_ar')}}</label>
                        <input type="text" name = "name_ar" class = "form-control" value = "{{$educational_stage->getTranslation('name' , 'ar')}}">
                    </div>
                    {{-- name en --}}
                    <div class="form-group">
                        <label for="name_en">{{__('general.name_en')}}</label>
                        <input type="text" name = "name_en" class = "form-control" value = "{{$educational_stage->getTranslation('name' , 'en')}}">
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