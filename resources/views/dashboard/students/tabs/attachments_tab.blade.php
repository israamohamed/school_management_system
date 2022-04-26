<div class="tab-pane" id="attachments" role="tabpanel">
    <p class="mb-0">

      <div class = "my-3">
        <button type="button" class="btn btn-success waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_attachment_modal">{{__('general.attachments.create')}}</button>
        @include('dashboard.students.attachments.create')
        <div class="clearfix"></div>
      </div>
     


      @if(count($student->main_attachments) > 0)
     <table class = "table table-bordered table-hover">
       <thead>
          <th>#</th>
          <th>{{__('general.attachment')}}</th>
          <th>{{__('general.actions')}}</th>
       </thead>
       <tbody>
          @foreach($student->main_attachments as $attachment)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>
              <a class="image-popup-no-margins" href="{{$attachment->url}}">
                <img src="{{$attachment->url}}" style = "height: 80px;" alt=""></td>
              </a>
            <td>
              <a class ="btn btn-primary btn-sm" href="{{route('dashboard.student.download_attachment' , $attachment->id)}}"><i class = " fas fa-download"></i></a>

              <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_attachment_modal_{{$attachment->id}}"><i class = "fas fa-trash"></i></button>
              @include('dashboard.students.attachments.delete')

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