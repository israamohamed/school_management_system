<div class="tab-pane active" id="attachments" role="tabpanel">
    <p class="mb-0">
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
                <img src="{{$attachment->url}}" style = "width: 80px;" alt=""></td>
              </a>
            <td></td>
          </tr>
           
          @endforeach
       </tbody>
     </table>
    </p>
</div>