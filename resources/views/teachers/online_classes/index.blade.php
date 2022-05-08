@extends('teachers.master')

@section('title' , __('online_classes.title'))

@push('styles')

@endpush

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('online_classes.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('teacher.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('online_classes.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

{{-- Filters --}}
<div style = "margin: 10px 0;">
    <form method = "GET">
        <div class="row">
            <div class="col-md-3">
                <input type="text" name = "search" class = "form-control" value = "{{request()->search}}" onchange="this.form.submit()" placeholder="{{__('general.search')}}">
            </div>

            <div class="col-md-3">
                <select name="educational_class_room_id" class = "form-control select2 educational_class_room_selected"  onchange="this.form.submit()" placeholder="{{__('general.educational_class_rooms.one')}}">
                    <option value="">{{__('general.all')}}</option>
                        @foreach($educational_class_rooms as $educational_class_room)
                            <option value="{{$educational_class_room->id}}" {{$educational_class_room->id == request()->educational_class_room_id ? 'selected' : ''}} >{{$educational_class_room->name}}</option>
                        @endforeach
                </select>
            </div>

        </div>
    </form>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('online_classes.title')}} <span class="badge rounded-pill bg-dark">{{$online_classes->total()}}</span> </h4>
                    <a href = "{{route('teacher.online_class.create')}}" class="btn btn-primary waves-effect waves-light float-end">{{__('online_classes.create')}}</a>
                
                    <div class="clearfix"></div>
                </div>

               
                @if(count($online_classes) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                  
                                    <th>{{__('online_classes.meeting_id')}}</th>
                                    <th>{{__('online_classes.topic')}}</th>
                                    <th>{{__('online_classes.start_time')}}</th>
                                    <th>{{__('online_classes.duration')}}</th>
                                     
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($online_classes as $online_class)
                                <tr>        
                                    <td class="text-bold-500">{{$loop->iteration}}</td>
                                   
                                    <td>{{$online_class->meeting_id}}</td>
                                    <td>{{$online_class->topic }}</td>
                                    <td>{{$online_class->start_time }}</td>
                                    <td>{{$online_class->duration}}</td>
                                   
                                    <td>

                                        {{-- start --}}
                                        <button class = "btn btn-info btn-sm" title="{{__('online_classes.start_class')}}" data-bs-toggle="modal" data-bs-target="#start_modal_{{$online_class->id}}"><i class = " fas fa-address-card"></i></button>
                                        @include('teachers.online_classes.start')   

                                        {{-- join --}}
                                        <button class = "btn btn-success btn-sm" title="{{__('online_classes.join_class')}}" data-bs-toggle="modal" data-bs-target="#join_modal_{{$online_class->id}}"><i class = " fas fa-file-export"></i></button>
                                        @include('teachers.online_classes.join')    
                                          
                                        {{-- delete --}}
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$online_class->id}}"><i class = "fas fa-trash"></i></button>
                                        @include('teachers.online_classes.delete')

                                                                      
                                    </td>
                                </tr>               
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$online_classes->links()}}
                @else 
                    <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection


@push('scripts')
<script>
    $(".select2").each(function(ele){
        var placeholder = $(this).attr("placeholder");

        $(this).select2({
            placeholder:  placeholder,
        });
    });

</script>


<script>
    function copy_join_url() {
        /* Get the text field */
        var join_url_text = $(".join_url");

        /* Select the text field */
        join_url_text.select();
        //join_url_text.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(join_url_text.val());

        toastr.success("{{__('general.copy_to_clipboard')}}")
    }

    function copy_start_url() {
        /* Get the text field */
        var start_url_text = $(".start_url");

        /* Select the text field */
        start_url_text.select();
        //start_url_text.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(start_url_text.val());

        toastr.success("{{__('general.copy_to_clipboard')}}")
    }
</script>

@endpush