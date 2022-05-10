@extends('students.master')

@section('title' ,  $subject->name )

@push('styles')
 <!-- Lightbox css -->
 <link href="{{asset('dashboard/assets/libs/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{ $subject->name }}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('student.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{ $subject->name }}</li>
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


                <h3 class = "text-center text-success" style = "margin-top: 20px;">{{__('general.subjects.attachments')}}</h3>
           

                @if(count($attachments) > 0)
                <table class = "table table-bordered table-hover">
                  <thead>
                     <th>{{__('general.created_at')}}</th>
                     <th>{{__('general.attachments.description')}}</th>
                   
                  </thead>
                  <tbody>
                     @foreach($attachments as $attachment)
                     <tr style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#show_attachment_modal_{{$attachment->id}}">
                       <td class = "col-md-1">{{$attachment->created_at}}</td>
                   
                       
                        <td class = "col-md-6">{{Str::limit($attachment->description , 150)}}</td>

                        {{-- <td class = "col-md-3">
                            <a class ="btn btn-primary btn-sm" href="{{route('student.subject.download_attachment' , $attachment->id)}}"><i class = " fas fa-download"></i></a>


                            <button class = "btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit_attachment_modal_{{$attachment->id}}"><i class = "fas fa-edit"></i></button>
                            @include('students.subjects.attachments.edit')
           
                            <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_attachment_modal_{{$attachment->id}}"><i class = "fas fa-trash"></i></button>
                            @include('students.subjects.attachments.delete')
                        </td> --}}
                     </tr>
                     @include('students.subjects.attachments.show')
                      
                     @endforeach
                  </tbody>
                </table>

              
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