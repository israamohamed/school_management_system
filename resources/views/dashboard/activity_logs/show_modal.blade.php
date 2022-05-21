   <!--primary theme Modal -->
   <div class="modal fade " id="show_modal_{{$log->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$log->description}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row m-2  ">
                    <div class="col-md-12">
                        <table class = "table table-sm">
                          <tbody>
                            <tr>
                                <th>{{__('general.created_at')}}</th>  
                                <td>{{ $log->created_at }}</td>
                            </tr>

                              <tr>
                                  <th>{{__('activity_logs.the_subject')}}</th>  
                                  <td>{{__('activity_logs.' . $log->log_name)}}</td>
                              </tr>

                              <tr>
                                <th>{{__('general.description')}}</th>  
                                <td>{{ $log->description }}</td>
                              </tr>

                              <tr>
                                <th>{{__('general.created_by')}}</th>  
                                <td>{{ $log->causer ? $log->causer->name : ''  }}</td>
                              </tr>
                          </tbody>
                        </table>
                    </div>
  
                </div>




                <div class="row m-2  ">
                    <div class="col-md-6">
                        <table class = "table table-sm">
                          <tbody>

                            <label>{{__('activity_logs.data')}}</label>
                            @if( isset($log->changes['attributes']) )
                                @foreach($log->changes['attributes'] as $key =>  $attribute)
                                <tr>
                                    <th>{{ __('activity_logs.properties.' . $key)  }}</th>  
                                    <td><span style = "font-size: 0.9em;" class = "badge bg-primary">{{ $attribute }}</span></td>
                                </tr>
                                @endforeach
                            @endif

                            
                          </tbody>
                        </table>
                    </div>


                    <div class="col-md-6">
                        <table class = "table table-sm">
                          <tbody>

                            <label>{{__('activity_logs.prev_data')}}</label>
                            @if( isset($log->changes['old']) )
                                @foreach($log->changes['old'] as $key =>  $attribute)
                                <tr>
                                    <th>{{ __('activity_logs.properties.' . $key)  }}</th>  
                                    <td><span style = "font-size: 0.9em;" class = "badge bg-primary">{{ $attribute }}</span></td>
                                </tr>
                                @endforeach
                            @endif
                          </tbody>

                        </table>
                    </div>
  
                </div>
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
            </div>
         
        </div>
    </div>
 </div>