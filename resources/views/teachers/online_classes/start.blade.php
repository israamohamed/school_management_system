   <!--primary theme Modal -->
   <div class="modal fade " id="start_modal_{{$online_class->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$online_class->topic}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <textarea type="text" class = "form-control start_url mb-2">{{$online_class->start_url}}</textarea>
             
                <button title = "{{__('general.copy_to_clipboard')}}" class = "btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{__('general.copy_to_clipboard')}}" onclick="copy_start_url()"><i class = "far fa-copy"></i></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <a target="_Blank" href="{{$online_class->start_url}}" class="btn btn-info waves-effect">{{__('online_classes.start_class')}}</a>
            </div>
        
        </div>
    </div>
 </div>