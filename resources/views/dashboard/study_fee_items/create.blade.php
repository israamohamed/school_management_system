   <!--primary theme Modal -->
   <div class="modal fade " id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{__('accounts.study_fee_items.create')}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('dashboard.study_fee_item.store')}}" method = "post">
                 @csrf
                 {{--name ar --}}
                 <div class="form-group">
                     <label for="name_ar">{{__('general.name_ar')}}</label>
                     <input type="text" name = "name_ar" class = "form-control" value = "{{old('name_ar')}}">
                 </div>
                 {{-- name en --}}
                 <div class="form-group">
                     <label for="name_en">{{__('general.name_en')}}</label>
                     <input type="text" name = "name_en" class = "form-control" value = "{{old('name_en')}}">
                 </div>

                 {{-- type : mandatory / optional --}}
                 <div class="form-group">
                    <label for="type">{{__('general.type')}}</label>
                    <select name="type" class = "form-select">
                        <option value="mandatory" {{old('type') == 'mandatory' ? 'selected' : ''}}>{{__('accounts.mandatory')}}</option>
                        <option value="optional" {{old('type') == 'optional' ? 'selected' : ''}}>{{__('accounts.optional')}}</option>
                    </select>                   
                </div>
 
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('general.add')}}</button>
            </div>
         </form>
        </div>
    </div>
 </div>