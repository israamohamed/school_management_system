<div class="tab-pane" id="student_parent_date" role="tabpanel">
    <p class="mb-0">
      <div class="row">
        <div class="col-md-6">
          {{-- father details --}}
          <table class = "table table-bordered">
            <h4 class = "alert-primary p-2">{{__('student_parents.father_details')}}</h4>
            <tbody>
              <tr>
                <th>{{__('student_parents.father_name_ar')}}</th>
                <td>{{$student->student_parent ? $student->student_parent->getTranslation('father_name' , 'ar') : "--"}}</td>
              </tr>

              <tr>
                <th>{{__('student_parents.father_name_en')}}</th>
                <td>{{$student->student_parent ? $student->student_parent->getTranslation('father_name' , 'en') : "--"}}</td>
              </tr>

              <tr>
                  <th>{{__('student_parents.father_phone_number')}}</th>
                  <td>{{$student->student_parent ? $student->student_parent->father_phone_number : "--"}}</td>
              </tr>

              <tr>
                  <th>{{__('student_parents.father_job')}}</th>
                  <td>{{$student->student_parent ? $student->student_parent->father_job : "--"}}</td>
              </tr>

              <tr>
                <th>{{__('student_parents.father_national_id')}}</th>
                <td>{{$student->student_parent ? $student->student_parent->father_national_id : "--"}}</td>
              </tr>

              <tr>
                <th>{{__('student_parents.father_passport_number')}}</th>
                <td>{{$student->student_parent ? $student->student_parent->father_passport_number : "--"}}</td>
              </tr>

              <tr>
                <th>{{__('student_parents.father_blood_type_id')}}</th>
                <td>{{$student->student_parent && $student->student_parent->father_blood_type ? $student->student_parent->father_blood_type->name : "--"}}</td>
              </tr>

              <tr>
                <th>{{__('student_parents.father_nationality_id')}}</th>
                <td>{{$student->student_parent && $student->student_parent->father_nationality ? $student->student_parent->father_nationality->name : "--"}}</td>
              </tr>

              <tr>
                <th>{{__('student_parents.father_relision_id')}}</th>
                <td>{{$student->student_parent && $student->student_parent->father_relision ? $student->student_parent->father_relision->name : "--"}}</td>
              </tr>

              <tr>
                <th>{{__('student_parents.father_address')}}</th>
                <td>{{$student->student_parent ? $student->student_parent->father_address : "--"}}</td>
              </tr>
            </tbody>

          </table>
        </div>


        <div class="col-md-6">
            {{-- mother details --}}
            <table class = "table table-bordered">
              <h4 class = "alert-primary p-2">{{__('student_parents.mother_details')}}</h4>
              <tbody>
                <tr>
                  <th>{{__('student_parents.mother_name_ar')}}</th>
                  <td>{{$student->student_parent ? $student->student_parent->getTranslation('mother_name' , 'ar') : "--"}}</td>
                </tr>
  
                <tr>
                  <th>{{__('student_parents.mother_name_en')}}</th>
                  <td>{{$student->student_parent ? $student->student_parent->getTranslation('mother_name' , 'en') : "--"}}</td>
                </tr>
  
                <tr>
                    <th>{{__('student_parents.mother_phone_number')}}</th>
                    <td>{{$student->student_parent ? $student->student_parent->mother_phone_number : "--"}}</td>
                </tr>
  
                <tr>
                    <th>{{__('student_parents.mother_job')}}</th>
                    <td>{{$student->student_parent ? $student->student_parent->mother_job : "--"}}</td>
                </tr>
  
                <tr>
                  <th>{{__('student_parents.mother_national_id')}}</th>
                  <td>{{$student->student_parent ? $student->student_parent->mother_national_id : "--"}}</td>
                </tr>
  
                <tr>
                  <th>{{__('student_parents.mother_passport_number')}}</th>
                  <td>{{$student->student_parent ? $student->student_parent->mother_passport_number : "--"}}</td>
                </tr>
  
                <tr>
                  <th>{{__('student_parents.mother_blood_type_id')}}</th>
                  <td>{{$student->student_parent && $student->student_parent->mother_blood_type ? $student->student_parent->mother_blood_type->name : "--"}}</td>
                </tr>
  
                <tr>
                  <th>{{__('student_parents.mother_nationality_id')}}</th>
                  <td>{{$student->student_parent && $student->student_parent->mother_nationality ? $student->student_parent->mother_nationality->name : "--"}}</td>
                </tr>
  
                <tr>
                  <th>{{__('student_parents.mother_relision_id')}}</th>
                  <td>{{$student->student_parent && $student->student_parent->mother_relision ? $student->student_parent->mother_relision->name : "--"}}</td>
                </tr>
  
                <tr>
                  <th>{{__('student_parents.mother_address')}}</th>
                  <td>{{$student->student_parent ? $student->student_parent->mother_address : "--"}}</td>
                </tr>
              </tbody>
  
            </table>
        </div>
      </div>
    </p>
</div>