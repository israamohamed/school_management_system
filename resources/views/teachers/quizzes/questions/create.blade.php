@extends('teachers.master')

@section('title' , __('quizzes.questions.create'))

@push('styles')

   
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('quizzes.questions.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('teacher.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('teacher.quiz.index')}}">{{__('quizzes.title')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('teacher.quiz.show' , $quiz->id)}}">{{$quiz->name}}</a></li>
            <li class="breadcrumb-item active">{{__('quizzes.questions.create')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('quizzes.questions.create')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('teacher.question.store')}}" method = "post" enctype="multipart/form-data" class="repeater">
                        @csrf


                        <input type="hidden" name = "quiz_id" value = "{{$quiz->id}}">



                        <button type = "button"  data-repeater-create class="btn btn-success rounded waves-effect waves-light">{{__('quizzes.questions.add_another')}}</button>
                    
                        <br><br>
                        <div class = "clearfix"></div>
                        
                        <div>

                            <table class = "table table-bordered">
                                <thead>
                                    <tr>
                                        <th class = "text-center">{{__('quizzes.questions.one')}}</th>
                                        <th class = "text-center">{{__('quizzes.questions.score')}}</th>
                                        <th class = "text-center">{{__('quizzes.questions.correct_choice')}}</th>
                                        <th class = "text-center">{{__('quizzes.questions.wrong_choices')}}</th>
                                        <th class = "text-center">{{__('general.delete')}}</th>
                                    </tr>
                                </thead>
                                <tbody data-repeater-list="questions">

                                    @if(old('questions'))
                                        @foreach( old('questions') as $question )
                                        <tr data-repeater-item>
                                            <td>
                                                <textarea name = "title" class = "form-control">{{$question['title']}}</textarea>
                                            </td>

                                            <td>
                                                <input type="number" name = "score" value = "{{$question['score']}}" class = "score form-control @error('score') is-invalid @enderror" placeholder="{{__('quizzes.questions.score')}}">
                                            </td>

                                            <td>
                                                <input type="text" name = "correct_choice" value = "{{$question['correct_choice']}}" class = "correct_choice form-control @error('correct_choice') is-invalid @enderror" placeholder="{{__('quizzes.questions.correct_choice')}}">
                                            </td>

                                            <td>
                                                <div class="row"> 
                                                    @for($i = 0; $i < 3; $i++)
                                                        <div class = "col-md-4">
                                                            <input type="text" name = "wrong_choices" multiple value = "{{$question['wrong_choices'][$i]}}" class = "wrong_choices form-control @error('wrong_choices') is-invalid @enderror" placeholder="{{__('quizzes.questions.wrong_choices')}}">
                                                        </div> 
                                                    @endfor 
                                                </div>     
                                            </td>
                                            <td>
                                                <button class = "btn btn-danger form-control" data-repeater-delete type = "button">{{__('general.delete')}}</button>
                                            </td>
                                        </tr>
                                        @endforeach
    
                                    @else 
                                        <tr data-repeater-item>
                                            <td>
                                                <textarea name = "title" class = "form-control"></textarea>
                                            </td>

                                            <td>
                                                <input type="number" name = "score" class = "score form-control @error('score') is-invalid @enderror" placeholder="{{__('quizzes.questions.score')}}">
                                            </td>

                                            <td>
                                                <input type="text" name = "correct_choice" class = "correct_choice form-control @error('correct_choice') is-invalid @enderror" placeholder="{{__('quizzes.questions.correct_choice')}}">
                                            </td>

                                            <td>
                                                <div class="row"> 
                                                    @for($i = 0; $i < 3; $i++)
                                                        <div class = "col-md-4">
                                                            <input type="text" name = "wrong_choices" multiple class = "wrong_choices form-control @error('wrong_choices') is-invalid @enderror" placeholder="{{__('quizzes.questions.wrong_choices')}}">
                                                        </div> 
                                                    @endfor 
                                                </div>     
                                            </td>
                                            <td>
                                                <button class = "btn btn-danger form-control" data-repeater-delete type = "button">{{__('general.delete')}}</button>
                                            </td>
                                        </tr>
                                    @endif
                               
                                </tbody>
                            </table>


                           
                        </div>

       
                        <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light float-end my-4">
                            <i class="ri-check-line align-middle me-2"></i>
                            {{__('general.add')}}
                        </button>

                    </form>
                    
                </div>
             

            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')

<script src="{{asset('dashboard/assets/js/jquery.repeater.js')}}"></script>
    
<script>
        $(document).ready(function() {

        $(".select2").select2();


        $('.repeater').repeater({
        // (Optional)
        // start with an empty list of repeaters. Set your first (and only)
        // "data-repeater-item" with style="display:none;" and pass the
        // following configuration flag
        initEmpty: false,
        // (Optional)
        // "defaultValues" sets the values of added items.  The keys of
        // defaultValues refer to the value of the input's name attribute.
        // If a default value is not specified for an input, then it will
        // have its value cleared.
        defaultValues: {
            'text-input': 'foo'
        },
        // (Optional)
        // "show" is called just after an item is added.  The item is hidden
        // at this point.  If a show callback is not given the item will
        // have $(this).show() called on it.
        show: function () {
            $(this).slideDown();
          
        },
        // (Optional)
        // "hide" is called when a user clicks on a data-repeater-delete
        // element.  The item is still visible.  "hide" is passed a function
        // as its first argument which will properly remove the item.
        // "hide" allows for a confirmation step, to send a delete request
        // to the server, etc.  If a hide callback is not given the item
        // will be deleted.
        hide: function (deleteElement) {
            if(confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        },
        // (Optional)
        // You can use this if you need to manually re-index the list
        // for example if you are using a drag and drop library to reorder
        // list items.
        /*ready: function (setIndexes) {
            $dragAndDrop.on('drop', setIndexes);
        },*/
        // (Optional)
        // Removes the delete button from the first list item,
        // defaults to false.
        isFirstItemUndeletable: true
    })
});

    
</script>

@endpush