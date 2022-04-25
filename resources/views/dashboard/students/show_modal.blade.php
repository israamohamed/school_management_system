   <!--primary theme Modal -->
   <div class="modal fade " id="show_modal_{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$student->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="row m-2">
                  <div class="col-md-2  border border-primary">
                      <img src="{{$student->profile_picture}}" style = "width: 100%" alt="{{$student->name}}">
                  </div>

                  <div class="col-md-10  border border-primary">
                      <table class = "table table-sm">
                          <tbody>
                              <tr>
                                  <th>{{__('students.name_ar')}}</th>  
                                  <td>{{$student->getTranslation('name' , 'ar')}}</td>
                              </tr>

                              <tr>
                                <th>{{__('students.name_en')}}</th>  
                                <td>{{$student->getTranslation('name' , 'en')}}</td>
                              </tr>

                              <tr>
                                <th>{{__('students.code')}}</th>  
                                <td>{{$student->code}}</td>
                              </tr>

                              <tr>
                                <th>{{__('students.national_id')}}</th>  
                                <td>{{$student->national_id}}</td>
                              </tr>

                              <tr>
                                <th>{{__('general.class_rooms.one')}}</th>  
                                <td>
                                    {{$student->educational_stage() ? $student->educational_stage()->name : ''}} - 
                                    {{$student->class_room ? $student->class_room->name : ''}} - 
                                    {{$student->educational_class_room ? $student->educational_class_room->name : ''}}
                                </td>
                              </tr>

                              <tr>
                                <th>{{__('students.birth_date')}}</th>  
                                <td>{{$student->birth_date}}</td>
                              </tr>
                            
                          </tbody>
                      </table>
                  </div>
              </div>
              <br>

              <div class="row m-2  border border-primary">
                  <div class="col-md-6">
                      <table class = "table table-sm ">
                        <tbody>
                            <tr>
                                <th>{{__('students.email')}}</th>  
                                <td>{{$student->email}}</td>
                              </tr>

                              <tr>
                                <th>{{__('students.address')}}</th>  
                                <td>{{Str::limit($student->address , 50)}}</td>
                              </tr>

                              <tr>
                                <th>{{__('students.gender')}}</th>  
                                <td>{{__('general.' . $student->gender)}}</td>
                              </tr>


                            <tr>
                                <th>{{__('student_parents.father_name')}}</th>
                                <td>{{$student->student_parent ? $student->student_parent->father_name : "--"}}</td>
                            </tr>

                            <tr>
                                <th>{{__('student_parents.father_phone_number')}}</th>
                                <td>{{$student->student_parent ? $student->student_parent->father_phone_number : "--"}}</td>
                            </tr>

                            <tr>
                                <th>{{__('student_parents.father_job')}}</th>
                                <td>{{$student->student_parent ? $student->student_parent->father_job : "--"}}</td>
                            </tr>
                        </tbody>
                      </table>
                  </div>

                  <div class="col-md-6">
                    <table class = "table table-sm ">

                        <tbody>
                            <tr>
                                <th>{{__('students.joining_date')}}</th>  
                                <td>{{$student->joining_date}}</td>
                              </tr>

                              <tr>
                                <th>{{__('students.phone_number1')}}</th>  
                                <td>{{$student->phone_number1}}</td>
                              </tr>

                              <tr>
                                <th>{{__('students.phone_number2')}}</th>  
                                <td>{{$student->phone_number2}}</td>
                              </tr>

                            <tr>
                                <th>{{__('student_parents.mother_name')}}</th>
                                <td>{{$student->student_parent ? $student->student_parent->mother_name : "--"}}</td>
                            </tr>

                            <tr>
                                <th>{{__('student_parents.mother_phone_number')}}</th>
                                <td>{{$student->student_parent ? $student->student_parent->mother_phone_number : "--"}}</td>
                            </tr>

                            <tr>
                                <th>{{__('student_parents.mother_job')}}</th>
                                <td>{{$student->student_parent ? $student->student_parent->mother_job : "--"}}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
              </div>
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
            </div>
         
        </div>
    </div>
 </div>