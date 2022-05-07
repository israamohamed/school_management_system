   <!--primary theme Modal -->
   <div class="modal fade " id="edit_question_modal_{{$question->id}}" role="dialog" aria-labelledby="create_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title white">
                    {{ Str::limit($question->title , 20)}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('teacher.question.update' , $question->id )}}" method = "post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name = "quiz_id" value = "{{$quiz->id}}">

                {{-- title --}}
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">{{__('quizzes.questions.one')}}</label>
                            <textarea type="text" name = "title" class = "form-control">{{$question->title}}</textarea>
                        </div>
                    </div>
                </div>
              

                {{-- score --}}
                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="score">{{__('quizzes.questions.score')}}</label>
                            <input type="number" name = "score" class = "form-control" value = "{{$question->score}}">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        {{-- correct_choice --}}
                        <div class="form-group">
                            <label for="correct_choice">{{__('quizzes.questions.correct_choice')}}</label>
                            <input type="text" name = "correct_choice" class = "form-control" value = "{{$question->choices()->where('correct' , 1)->first() ? $question->choices()->where('correct' , 1)->first()->title : ''}}">
                        </div>
                    </div>
                </div>


                <div class="row mb-2">
                    <div class="col-md-12">
                        {{-- wrong_choices --}}
                        <div class="form-group">
                            <label for="wrong_choices">{{__('quizzes.questions.wrong_choices')}}</label>
                            @foreach($question->choices()->where('correct' , 0)->get() as $wrong_choice )

                                <input type="text" name = "wrong_choices[]" class = "form-control mb-1" value = "{{$wrong_choice->title}}">

                            @endforeach
                        </div>
                    </div>
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-info waves-effect waves-light">{{__('general.edit')}}</button>
            </div>
         </form>
        </div>
    </div>
 </div>

 @push('scripts')
<script>
    /*$(".select2_create_modal").select2({
        dropdownParent: $("#create_modal"),
    });*/
</script>
@endpush