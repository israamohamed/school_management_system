   <!--primary theme Modal -->
   <div class="modal fade " id="create_modal" role="dialog" aria-labelledby="create_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="create_modal_label">
                    {{__('general.educational_class_rooms.create')}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('dashboard.educational_class_room.store')}}" method = "post">
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
                 {{-- educational stage --}}
                 <div class="form-group">
                    <label for="educational_stage_id">{{__('general.educational_stages.one')}}</label>
                    <select name="educational_stage_id" class = "form-control educational_stage_selected select2 select2-modal" style = "width: 100%;">
                        <option value="">{{__('general.educational_stages.one')}}</option>
                            @foreach($educational_stages as $educational_stage)
                                <option value="{{$educational_stage->id}}" {{$educational_stage->id == old('educational_stage_id') ? 'selected' : ''}} >{{$educational_stage->name}}</option>
                            @endforeach
                    </select>
                 </div>
                  {{-- class room  --}}
                  <div class="form-group">
                    <label for="class_room_id">{{__('general.class_rooms.one')}}</label>
                    <select name="class_room_id" class = "form-control class_room_selected select2 select2-modal">
                        
                    </select>
                 </div>
                 {{-- class room  --}}
                 <div class="form-group">
                    <label for="number_of_students">{{__('general.number_of_students')}}</label>
                    <input type = "number" min = "0" name="number_of_students" value = "{{old('number_of_students')}}" class = "form-control">
                 </div>
                  {{-- Active --}}
                  <br>
                  <div class="form-group">
                    <label for="active">{{__('general.active')}}</label>
                    <input type="checkbox" name = "active" class = "form-check-input" id = "active" {{old('active') ? 'checked' : ''}} >
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

 @push('scripts')
<script>
    /*$(".select2_create_modal").select2({
        dropdownParent: $("#create_modal"),
    });*/
</script>
@endpush