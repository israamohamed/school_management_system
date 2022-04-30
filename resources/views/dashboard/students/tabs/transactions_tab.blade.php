<div class="tab-pane" id="transactions" role="tabpanel">
    <p class="mb-0">       
        
        <div class = "my-3">
            {{-- <button type="button" class="btn btn-success waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_attachment_modal">{{__('general.attachments.create')}}</button>
            @include('dashboard.students.attachments.create')
            <div class="clearfix"></div> --}}
          </div>
         
    
    
        @if(count($student->student_transactions) > 0)
            <table class = "table table-bordered table-hover">
                <thead>
                    <th>#</th>
                    <th>{{__('accounts.financial_bonds.type')}}</th>
                    <th>{{__('accounts.transaction_date')}}</th>
                   
                    <th>{{__('accounts.credit')}}</th>
                    <th>{{__('accounts.debit')}}</th>

                    <th>{{__('general.notes')}}</th>
                    <th>{{__('general.actions')}}</th>
                    
                </thead>
                <tbody>
                    @foreach($student->student_transactions as $transaction)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{__('accounts.' . $transaction->type)}}</td>
                        <td>{{$transaction->transaction_date}}</td>
                      
                        <td>
                            @if($transaction->credit > 0)
                                <span class = "badge bg-success" style = "font-size: 1.3em;">{{$transaction->credit}}</span>
                            @endif
                        </td>

                        <td>
                            @if($transaction->debit > 0)
                                <span class = "badge bg-danger" style = "font-size: 1.3em;">{{$transaction->debit}}</span>
                            @endif
                        </td>

                        <td>{{Str::limit($transaction->notes , 50)}}</td>
                        
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
