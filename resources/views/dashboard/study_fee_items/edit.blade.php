   <!--primary theme Modal -->
   <div class="modal fade" id="edit_modal_{{$study_fee_item->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$study_fee_item->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.study_fee_item.update' , $study_fee_item->id)}}" method = "post">
                    @csrf
                    @method('put')
                    {{--name ar --}}
                    <div class="form-group">
                        <label for="name_ar">{{__('general.name_ar')}}</label>
                        <input type="text" name = "name_ar" class = "form-control" value = "{{$study_fee_item->getTranslation('name' , 'ar')}}">
                    </div>
                    {{-- name en --}}
                    <div class="form-group">
                        <label for="name_en">{{__('general.name_en')}}</label>
                        <input type="text" name = "name_en" class = "form-control" value = "{{$study_fee_item->getTranslation('name' , 'en')}}">
                    </div>

                    {{-- type : mandatory / optional --}}
                    <div class="form-group">
                        <label for="type">{{__('general.type')}}</label>
                        <select name="type" class = "form-control">
                            <option value="mandatory" {{$study_fee_item->type == 'mandatory' ? 'selected' : ''}}>{{__('accounts.mandatory')}}</option>
                            <option value="optional" {{$study_fee_item->type  == 'optional' ? 'selected' : ''}}>{{__('accounts.optional')}}</option>
                        </select>                   
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