   <!--primary theme Modal -->
   <div class="modal fade " id="show_modal_{{$educational_class_room->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title white" id="myModalLabel160">
                  
                  <span class = "mx-2"> {{$educational_class_room->name}}</span>
                  <span class = "mx-2"> {{request()->attendance_date}}</span>
                   
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <table class = "table">

                <thead>
                  <tr>
                    <th>{{__('students.one')}}</th>
                    <th>{{__('students.code')}}</th>
                    <th>{{__('students.student_attendances.attendance_status')}}</th>
                    <th>{{__('general.absence_reasons.one')}}</th>
                  </tr>

                </thead>

                <tbody>
                  @foreach($educational_class_room->attendances as $attendance)
                  <tr>
                    <td>{{$attendance->student ? $attendance->student->name : '' }}</td>
                    <td>{{$attendance->student ? $attendance->student->code : '' }}</td>
                    <th>
                      @if($attendance->attendance_status === 1)
                        <i class = " fas fa-check text-success" style = "font-size: 25px;"></i>
                      @elseif($attendance->attendance_status === 0)
                        <i class = "fas fa-window-close text-danger" style = "font-size: 25px;"></i>
                      @else 

                      @endif
                      
                    </th>
                    <th>{{$attendance->absence_reason ? $attendance->absence_reason->name : '' }}</th>

                  </tr>
                  @endforeach
                </tbody>

              </table>
            
            </div>
            <div class="modal-footer">
                {{-- <a class = "btn btn-warning" href="{{route('dashboard.student.show' , $student->id)}}">{{__('general.more_details')}}</a> --}}
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
            </div>
         
        </div>
    </div>
 </div>