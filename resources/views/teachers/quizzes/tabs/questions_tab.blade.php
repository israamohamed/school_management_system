<div class="tab-pane active" id="questions_tab" role="tabpanel">
    <p class="mb-0">

      <div class = "my-2">

        <a class ="btn btn-success waves-effect waves-light float-end" href="{{route('teacher.question.create' ,  ['quiz_id' => $quiz->id])}}">{{__('quizzes.questions.create')}}</a>

        {{-- <button type="button" class="btn btn-success waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_attachment_modal">{{__('quizzes.questions.create')}}</button> --}}
        {{-- @include('dashboard.students.attachments.create') --}}
        <div class="clearfix"></div>
      </div>
     


      @if(count($quiz->questions) > 0)
     <table class = "table table-bordered table-hover">
       <thead>
          <th>#</th>
          <th>{{__('general.title')}}</th>
          <th>{{__('quizzes.questions.score')}}</th>
          <th>{{__('quizzes.questions.choices')}}</th>
          <th>{{__('general.actions')}}</th>
       </thead>
       <tbody>
          @foreach($quiz->questions as $question)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{Str::limit($question->title , 50)}}</td>
            <td>{{$question->score}}</td>
            <td>
              @foreach($question->choices as $choice)
                <p style = "font-size: 1.2em;font-weight: bold;" class = "{{$choice->correct ? 'text-success' : 'text-danger'}}">{{$choice->title}}</p>
              @endforeach
            </td>
            <td>


              <button class = "btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit_question_modal_{{$question->id}}"><i class = "fas fa-edit"></i></button>
              @include('teachers.quizzes.questions.edit')



              <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_question_modal_{{$question->id}}"><i class = "fas fa-trash"></i></button>
              @include('teachers.quizzes.questions.delete')
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