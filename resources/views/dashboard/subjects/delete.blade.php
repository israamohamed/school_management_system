   <!--primary theme Modal -->
   <div class="modal fade " id="delete_modal_{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$subject->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.subject.destroy' , $subject->id)}}" 
                        method = "post" >
                 @csrf
                 @method('delete')
        
                    <h3>{{__('messages.are_you_sure')}}</h3>
                    <p>{{__('messages.delete_warning')}}</p>
              
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{__('general.delete')}}</button>
            </div>
         </form>
        </div>
    </div>
 </div>