   <!--primary theme Modal -->
   <div class="modal fade " id="show_modal_{{$quiz->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$quiz->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <div class="row m-2">

                  <div class="col-md-12  border border-primary">
                      <table class = "table table-sm">
                          <thead class = "alert alert-warning">
                              <th>#</th>
                              <th>{{__('quizzes.questions.one')}}</th>
                              <th>{{__('quizzes.your_answer')}}</th>
                              <th>{{__('quizzes.questions.choice')}}</th>
                              <th>{{__('quizzes.questions.score')}}</th>
                              <th>{{__('quizzes.questions.correct_choice')}}</th>
                          </thead>
                          <tbody>
                            @foreach($quiz->questions as $question)
                              <tr>
                                  <th>{{$loop->iteration}}</th>  
                                  <th>{{$question->title}}</th>  
                                  <td>{{$question->pivot->answer}}</td>
                                  <td>
                                    @if($question->pivot->correct)
                                            <span style = "font-size:1.5em;"><i class = "fas fa-check text-success"></i></span>
                                      @else 
                                            <span style = "font-size:1.5em;"><i class = " far fa-window-close text-danger"></i></span>
                                      @endif
                                  </td>
                                  <td>{{$question->pivot->score}}</td>
                                  <td>{{$question->correct_choice ? $question->correct_choice->title : '' }}</td>
                              </tr>
                              @endforeach

                             
                          </tbody>
                      </table>

                      
                  </div>
                  
                  <div class="col-md-12">
                    <h3 class = "m-4 text-center">{{__('quizzes.your_score')}}  :  <span class = "bg-warning px-5 py-2 rounded" style = "font-size: 1.4em;">{{$quiz->pivot->score}} / {{$quiz->score}}</span> </h3>
                  
                  </div>
              </div>
              <br>

             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
            </div>
         
        </div>
    </div>
 </div>