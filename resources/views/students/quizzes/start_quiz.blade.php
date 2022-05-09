<form action="{{route('student.quiz.start_quiz' , $quiz->id)}}" method = "post" id = "start_quiz_form_{{$quiz->id}}">
    @csrf 
    
</form>