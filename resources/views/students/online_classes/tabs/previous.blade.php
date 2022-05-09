<div class="tab-pane" id="previous_tab" role="tabpanel">
    <p class="mb-0">

      <div class = "my-2">

        <h4 class = "float-start">{{__('online_classes.previous_online_classes')}} <span class="badge rounded-pill bg-dark">{{$previous_online_classes->total()}}</span> </h4>
        <div class="clearfix"></div>
      </div>
     
      @if(count($previous_online_classes) > 0)
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
                    @foreach($previous_online_classes as $online_class)
                    <tr>        
                        <td class="text-bold-500">{{$loop->iteration}}</td>
                        
                        <td>{{$online_class->meeting_id}}</td>
                        <td>{{$online_class->topic }}</td>
                        <td>{{$online_class->start_time }}</td>
                        <td>{{$online_class->duration}}</td>
                        
                        <td>
                            {{-- join --}}
                           

                        </td>
                    </tr>               
                    @endforeach            
                </tbody>
            </table>
        </div> 
        {{$previous_online_classes->links()}}
      @else 
          <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
      @endif

    </p>
</div>