@extends('teachers.master')

@section('title' ,  $subject->name_in_details )

@push('styles')
 <!-- Lightbox css -->
 <link href="{{asset('dashboard/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{ $subject->name_in_details }}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('teacher.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{ $subject->name_in_details }}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <div class="clearfix"></div>
                </div>

                <div class="row  bg-dark p-3">
                    {{-- students --}}
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title text-muted">{{__('general.subjects.number_of_students')}}</h4>
                                <h2 class="mt-3 mb-2"><i class="fas fa-user-friends text-danger me-2"></i><b>{{ $number_of_students }}</b>
                                </h2>
                            </div>
                        </div>
                    </div>

                    {{-- attachments --}}
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title text-muted">{{__('general.subjects.number_of_attachments')}}</h4>
                                <h2 class="mt-3 mb-2"><i class="fas fa-cloud-upload-alt text-danger me-2"></i><b>{{ $number_of_attachments }}</b>
                                </h2>
                            </div>
                        </div>
                    </div>
                    {{--  quizzes --}}
                    <div class="col-sm-6 col-lg-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title text-muted">{{__('general.subjects.number_of_quizzes')}}</h4>
                                <h2 class="mt-3 mb-2"><i class="far fa-question-circle text-danger me-2"></i><b>{{ $number_of_quizzes }}</b>
                                </h2>
                            </div>
                        </div>
                    </div>

                </div>

               

                <h3 class = "text-center text-success" style = "margin-top: 20px;">{{__('general.subjects.attachments')}}</h3>
                <div class = "my-3">
                    <button type="button" class="btn btn-success waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_attachment_modal">{{__('general.attachments.create')}}</button>
                    @include('teachers.subjects.attachments.create')
                    <div class="clearfix"></div>
                </div>



                @if(count($attachments) > 0)
                <table class = "table table-bordered table-hover">
                  <thead>
                     <th class = "col-md-1">#</th>
                     <th class = "col-md-2">{{__('general.attachment')}}</th>
                     <th class = "col-md-6">{{__('general.attachments.description')}}</th>
                     <th class = "col-md-3">{{__('general.actions')}}</th>
                  </thead>
                  <tbody>
                     @foreach($attachments as $attachment)
                     <tr>
                       <td class = "col-md-1">{{$loop->iteration}}</td>
                       <td class = "col-md-2">
                         <a class="image-popup-no-margins" href="{{$attachment->url}}">
                           <img src="{{$attachment->url}}" style = "width:100%;" alt="">
                        </td>
                         </a>
                       
                        <td class = "col-md-6">{{Str::limit($attachment->description , 150)}}</td>

                        <td class = "col-md-3">
                            <a class ="btn btn-primary btn-sm" href="{{route('teacher.subject.download_attachment' , $attachment->id)}}"><i class = " fas fa-download"></i></a>


                            <button class = "btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit_attachment_modal_{{$attachment->id}}"><i class = "fas fa-edit"></i></button>
                            @include('teachers.subjects.attachments.edit')
           
                            <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_attachment_modal_{{$attachment->id}}"><i class = "fas fa-trash"></i></button>
                            @include('teachers.subjects.attachments.delete')
                        </td>
                       
           
                       
                     </tr>
                      
                     @endforeach
                  </tbody>
                </table>

                {{$attachments->links()}}
                @else 
                 <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif
               
             
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')

 <!-- Magnific Popup-->
 <script src="{{asset('dashboard/assets/libs/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

 <!-- lightbox init js-->
 <script src="{{asset('dashboard/assets/js/pages/lightbox.init.js')}}"></script>

<script>
    $(".select2").each(function(ele){
        var placeholder = $(this).attr("placeholder");

        $(this).select2({
            placeholder:  placeholder,
        });
    });

</script>

@endpush