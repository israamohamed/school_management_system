
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
                    @foreach($student->student_invoices as $student_invoice)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$student_invoice->invoice_date}}</td>
                        <td>{{$student_invoice->study_fee ? $student_invoice->study_fee->title : '--'}}</td>
                        <td><span style = "font-size: 1.3em;">{{$student_invoice->final_total}}</span></td>
                        <td>
                            @if($student_invoice->discount)
                                <span class = "badge bg-success rounded-pill" style = "font-size: 1.1em;">{{$student_invoice->discount}}   {{$student_invoice->discount_type == 'percentage' ? '%' : ''}} </span>
                            @else 
                            @endif
                        </td>
                        <td>{{Str::limit($student_invoice->notes , 50)}}</td>
                        
                        <td>
            
                            <button class = "btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit_student_invoice_modal_{{$student_invoice->id}}" {{auth()->user()->can('edit.student_invoice') ? '' : 'disabled' }} ><i class = "fas fa-edit"></i></button>
                            @include('dashboard.student_invoices.edit')

                            <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_student_invoice_modal_{{$student_invoice->id}}"  {{auth()->user()->can('delete.student_invoice') ? '' : 'disabled' }}><i class = "fas fa-trash"></i></button>
                            @include('dashboard.student_invoices.delete')
            
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