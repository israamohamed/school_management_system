   <!--primary theme Modal -->
   <div class="modal fade " id="create_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{__('general.class_rooms.create')}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('dashboard.class_room.store')}}" method = "post" class="repeater">
                 @csrf
                 <button type = "button"  data-repeater-create class="btn btn-success rounded-pill">{{__('general.add')}}</button>
                <br><br>
                <div class = "clearfix"></div>


                <table class = "table table-bordered">
                    <thead>
                        <tr>
                            <th>{{__('general.name_ar')}}</th>
                            <th>{{__('general.name_en')}}</th>
                            <th>{{__('general.educational_stages.one')}}</th>
                            <th>{{__('general.last_class_room')}}</th>
                            <th>{{__('general.actions')}}</th>
                        </tr>
                       
                    </thead>
                    <tbody data-repeater-list="class_rooms">
                        <tr data-repeater-item>
                            <td><input type="text" name = "name_ar" class = "form-control" placeholder="{{__('general.name_ar')}}" ></td>
                            <td><input type="text" name = "name_en" class = "form-control" placeholder="{{__('general.name_en')}}" ></td>
                            <td>
                                <select name="educational_stage_id" class = "form-control" style = "width: 100%;" >
                                    <option value="">{{__('general.educational_stages.one')}}</option>
                                    @foreach($educational_stages as $educational_stage)
                                        <option value="{{$educational_stage->id}}">{{$educational_stage->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="checkbox" class = "form-check-input"  name = "last_class_room"></td>
                            <td><button class = "btn btn-danger form-control" data-repeater-delete type = "button">{{__('general.delete')}}</button></td>
                        </tr>
                    </tbody>
                </table>
              
 
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('general.add')}}</button>
            </div>
         </form>
        </div>
    </div>
 </div>

 @push('scripts')
<script src="{{asset('dashboard/assets/js/jquery.repeater.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.repeater').repeater({
            // (Optional)
            // start with an empty list of repeaters. Set your first (and only)
            // "data-repeater-item" with style="display:none;" and pass the
            // following configuration flag
            initEmpty: false,
            // (Optional)
            // "defaultValues" sets the values of added items.  The keys of
            // defaultValues refer to the value of the input's name attribute.
            // If a default value is not specified for an input, then it will
            // have its value cleared.
            defaultValues: {
                'text-input': 'foo'
            },
            // (Optional)
            // "show" is called just after an item is added.  The item is hidden
            // at this point.  If a show callback is not given the item will
            // have $(this).show() called on it.
            show: function () {
                $(this).slideDown();
            },
            // (Optional)
            // "hide" is called when a user clicks on a data-repeater-delete
            // element.  The item is still visible.  "hide" is passed a function
            // as its first argument which will properly remove the item.
            // "hide" allows for a confirmation step, to send a delete request
            // to the server, etc.  If a hide callback is not given the item
            // will be deleted.
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // (Optional)
            // You can use this if you need to manually re-index the list
            // for example if you are using a drag and drop library to reorder
            // list items.
            /*ready: function (setIndexes) {
                $dragAndDrop.on('drop', setIndexes);
            },*/
            // (Optional)
            // Removes the delete button from the first list item,
            // defaults to false.
            isFirstItemUndeletable: true
        })
    });
</script>
@endpush