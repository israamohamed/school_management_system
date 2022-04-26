<div class="tab-pane active" id="student_date" role="tabpanel">
    <p class="mb-0">
        <div class="row mb-3">
            <div class="col-md-2  border border-primary">
                <a class="image-popup-no-margins" href="{{$student->profile_picture}}">
                    <img  class = "img-fluid avatar-lg" src="{{$student->profile_picture}}" style = "width: 100%;height: 100%;" alt="{{$student->name}}">
                </a>
            </div>

            <div class="col-md-10  border border-primary ">
                <table class = "table table-sm table-bordered">
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


        <div class="row mb-3  border border-primary">
            <div class="col-md-6">
                <table class = "table table-sm table-bordered">
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
                          <th>{{__('general.blood_types.one')}}</th>
                          <td>{{$student->blood_type ? $student->blood_type->name : "--"}}</td>
                      </tr>

                      <tr>
                        <th>{{__('general.nationalities.one')}}</th>
                        <td>{{$student->nationality ? $student->nationality->name : "--"}}</td>
                      </tr>

                        <tr>
                            <th>{{__('general.relisions.one')}}</th>
                            <td>{{$student->relision ? $student->relision->name : "--"}}</td>
                        </tr>
                  </tbody>
                </table>
            </div>

            <div class="col-md-6">
              <table class = "table table-sm table-bordered">

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
                            <th>{{__('students.birth_place_ar')}}</th>  
                            <td>{{$student->getTranslation('birth_place' , 'ar')}}</td>
                        </tr>

                        <tr>
                          <th>{{__('students.birth_place_en')}}</th>  
                          <td>{{$student->getTranslation('birth_place' , 'en')}}</td>
                        </tr>

                      <tr>
                          <th>{{__('student_parents.mother_job')}}</th>
                          <td>{{$student->student_parent ? $student->student_parent->mother_job : "--"}}</td>
                      </tr>
                  </tbody>

              </table>
          </div>
        </div>


        <div class="row mb-3  border border-primary">
            <div class="col-md-12">
                <h5>{{__('students.address')}}</h5>
                <p>{{$student->address}}</p>
            </div>

            <div class="col-md-12">
                <h5>{{__('students.notes')}}</h5>
                <p>{{$student->notes}}</p>
            </div>
        </div>
    </p>
</div>