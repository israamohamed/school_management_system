
<div class="tab-pane active" id="invoices" role="tabpanel">
    <p class="mb-0">       
        
        <div class = "my-3">
            {{-- <button type="button" class="btn btn-success waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#create_attachment_modal">{{__('general.attachments.create')}}</button>
            @include('dashboard.students.attachments.create')
            <div class="clearfix"></div> --}}
          </div>
         
    
    
        @if(count($student->student_invoices) > 0)
            <table class = "table table-bordered table-hover">
                <thead>
                    <th>#</th>
                    <th>{{__('accounts.invoice_date')}}</th>
                    <th>{{__('accounts.study_fees.title')}}</th>
                    <th>{{__('accounts.final_total')}}</th>
                    <th>{{__('accounts.discount')}}</th>
                    <th>{{__('general.notes')}}</th>
                    <th>{{__('general.actions')}}</th>
                    
                </thead>
                <tbody>
                    @foreach($student->student_invoices as $invoice)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$invoice->invoice_date}}</td>
                        <td>{{$invoice->study_fee ? $invoice->study_fee->title : '--'}}</td>
                        <td><span style = "font-size: 1.3em;">{{$invoice->final_total}}</span></td>
                        <td>
                            @if($invoice->discount)
                                <span class = "badge bg-success rounded-pill" style = "font-size: 1.1em;">{{$invoice->discount}}   {{$invoice->discount_type == 'percentage' ? '%' : ''}} </span>
                            @else 
                            @endif
                        </td>
                        <td>{{Str::limit($invoice->notes , 50)}}</td>
                        
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
