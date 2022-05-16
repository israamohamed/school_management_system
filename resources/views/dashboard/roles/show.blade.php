   <!--primary theme Modal -->
   <div class="modal fade " id="show_modal_{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title white" id="myModalLabel160">
                    {{$role->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label for="">{{__('general.roles.permissions')}}</label>
               <table class = "table">
                  
                   <tbody>
                       @foreach($role->permissions as $permission)
                       <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$permission->display_name}}</td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>
              
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
            </div>
        
        </div>
    </div>
 </div>