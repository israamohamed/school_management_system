<div class="tab-pane" id="financial_bonds" role="tabpanel">
    <p class="mb-0">       
        
        <div class = "my-3">
            {{-- <button type="button" class="btn btn-success waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_attachment_modal">{{__('general.attachments.create')}}</button>
            @include('dashboard.students.attachments.create')
            <div class="clearfix"></div> --}}
          </div>
         
    
    
        @if(count($student->financial_bonds) > 0)
            <table class = "table table-bordered table-hover">
                <thead>
                    <th>#</th>
                    <th>{{__('general.date')}}</th>
                    <th>{{__('accounts.financial_bonds.type')}}</th>
                    <th>{{__('general.amount')}}</th>
                  
                    <th>{{__('general.notes')}}</th>
                    <th>{{__('general.actions')}}</th>
                    
                </thead>
                <tbody>
                    @foreach($student->financial_bonds as $financial_bond)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$financial_bond->date}}</td>
                        <td>{{__('accounts.' . $financial_bond->type)}}</td>
                        <td>
                            <span class = "bg-dark p-1 rounded text-light" style = "font-size: 1.3em;">{{$financial_bond->amount}}</span>
                        </td>

                        <td>{{Str::limit($financial_bond->notes , 50)}}</td>
                        
                        <td>
            
                            {{-- <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_attachment_modal_{{$attachment->id}}"><i class = "fas fa-trash"></i></button>
                            @include('dashboard.students.attachments.delete') --}}
            
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
