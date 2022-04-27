   <!--primary theme Modal -->
   <div class="modal fade " id="return_modal_{{$graduated_student->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$student->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.graduated_student.destroy' , $graduated_student->id)}}" 
                        method = "post" 
                        >
                 @csrf
                 @method('delete')
        
                    <h3>{{__('messages.are_you_sure')}}</h3>
                    @php 
                        $educational_stage = 
                                            ($graduated_student->previous_academic_year) . ' ' . 
                    
                                            ($graduated_student->previous_educational_stage() ? $graduated_student->previous_educational_stage()->name : '')   . ' ' . 
                    
                                            ($graduated_student->previous_class_room ? $graduated_student->previous_class_room->name : '')
                    
                    @endphp
                    <p class = "text-danger font-weight-bold">{{__('messages.graduated_student_return_waring' , ['student' => $student->name , 'educational_stage' => $educational_stage  ])}}</p>
              
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-danger waves-effect waves-light">{{__('general.confirm')}}</button>
            </div>
         </form>
        </div>
    </div>
 </div>