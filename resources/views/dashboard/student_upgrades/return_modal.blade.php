   <!--primary theme Modal -->
   <div class="modal fade " id="return_modal_{{$student_upgrade->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$student->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.student_upgrade.destroy' , $student_upgrade->id)}}" 
                        method = "post" 
                        >
                 @csrf
                 @method('delete')
        
                    <h3>{{__('messages.are_you_sure')}}</h3>
                    @php 
                        $educational_stage = 
                                            ($student_upgrade->previous_academic_year) . ' ' . 
                    
                                            ($student_upgrade->previous_educational_stage() ? $student_upgrade->previous_educational_stage()->name : '')   . ' ' . 
                    
                                            ($student_upgrade->previous_class_room ? $student_upgrade->previous_class_room->name : '')
                    
                    @endphp
                    <p class = "text-danger font-weight-bold">{{__('messages.student_upgrade_return_waring' , ['student' => $student->name , 'educational_stage' => $educational_stage  ])}}</p>
              
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{__('general.confirm')}}</button>
            </div>
         </form>
        </div>
    </div>
 </div>