<div class="tab-pane" id="students_tab" role="tabpanel">
    <p class="mb-0">

      <div class = "my-2">

        <div class="clearfix"></div>
      </div>
     


      @if(count($quiz->questions) > 0)
      <table class = "table table-bordered table-hover">
        <thead>
              <th>#</th>
              <th>{{__('general.image')}}</th>
              <th>{{__('general.name')}}</th>
              <th>{{__('students.code')}}</th>
              <th>{{__('general.educational_class_rooms.one')}}</th>
              <th>{{__('quizzes.joined_before')}}</th>
              <th>{{__('quizzes.questions.score')}}</th>
        </thead>
        <tbody>
            @foreach($quiz->students as $student)
            <tr>
              <td>{{$loop->iteration}}</td>
              <td>
                  <a class="image-popup-no-margins" href="{{$student->profile_picture}}">
                      <img style = "height: 100px;" src="{{$student->profile_picture}}" alt="">
                  </a>
              </td>
              <td>{{$student->name}}</td>
              <td>{{$student->code}}</td>
              <td>{{$student->educational_class_room ? $student->educational_class_room->name : '--' }}</td>

              <td>
                @if($student->pivot->joined)
                    <span style = "font-size:1.5em;"><i class = " fas fa-check-double"></i></span>
                @else 
                    <span style = "font-size:1.5em;"><i class = " far fa-window-close"></i></span>
                @endif
            </td>

            <td>
              <span class = "bg-warning px-5 py-2 rounded" style = "font-size: 1.1em;">{{$student->pivot->score}} / {{$quiz->score}}</span>
            </td>

            </tr>
            
            @endforeach
        </tbody>
      </table>
      @else 
        <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
      @endif
    </p>
</div>