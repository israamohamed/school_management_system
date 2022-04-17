   <!--primary theme Modal -->
   <div class="modal fade" id="edit_modal_{{$class_room->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$class_room->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.class_room.update' , $class_room->id)}}" method = "post">
                    @csrf
                    @method('put')
                     {{--name ar --}}
                    <div class="form-group">
                        <label for="name_ar">{{__('general.name_ar')}}</label>
                        <input type="text" name = "name_ar" class = "form-control" value = "{{$class_room->getTranslation('name' , 'ar')}}">
                    </div>
                    {{-- name en --}}
                    <div class="form-group">
                        <label for="name_en">{{__('general.name_en')}}</label>
                        <input type="text" name = "name_en" class = "form-control" value = "{{$class_room->getTranslation('name' , 'en')}}">
                    </div>
                    {{-- educational stage --}}
                    <div class="form-group">
                        <label for="educational_stage_id">{{__('general.educational_stages.one')}}</label>
                        <select name="educational_stage_id" class = "form-control" style = "width: 100%;">
                            <option value="">{{__('general.educational_stages.one')}}</option>
                            @foreach($educational_stages as $educational_stage)
                                <option value="{{$educational_stage->id}}" {{$educational_stage->id == $class_room->educational_stage_id ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Last class room --}}
                    <div class="form-group">
                        <label for="last_class_room{{$class_room->id}}">{{__('general.last_class_room')}}</label>
                        <input type="checkbox" name = "last_class_room" class = "form-check-input" id = "last_class_room{{$class_room->id}}" {{$class_room->last_class_room ? 'checked' : ''}} >
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