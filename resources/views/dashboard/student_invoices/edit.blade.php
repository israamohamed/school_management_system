   <!--primary theme Modal -->
   <div class="modal fade " id="edit_student_invoice_modal_{{$student_invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light" id="myModalLabel160">
                    {{__('accounts.student_invoices.edit')}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.student_invoice.update' , $student_invoice->id)}}" method = "post" enctype="multipart/form-data" >
                 @csrf
                @method('PUT')
                 {{-- <input type="hidden" name = "student_id" value = "{{$student->id}}"> --}}

                {{-- study fee --}}
                 <div class="form-group mb-1 study_fee_parent">
                    <label for="study_fee_id">{{__('accounts.study_fees.one')}}</label>
                    <select name="study_fee_id" class = "study_fee form-control select2 select2-modal  @error('study_fee_id') is-invalid @enderror" onchange="changing_amount(this)">
                        <option value="">{{__('accounts.study_fees.select')}}</option>
                        @foreach($study_fees as $study_fee)
                            <option value="{{$study_fee->id}}" data-amount = "{{$study_fee->amount}}" {{ $student_invoice->study_fee_id == $study_fee->id ? 'selected' : ''}} >{{$study_fee->title}}</option>
                        @endforeach       
                    </select>
                    @error('study_fee_id')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                </div>  


                {{-- total --}}
                <div class="form-group mb-1 total_parent">
                    <label for="total">{{__('accounts.total')}} <i class = " fas fa-money-bill-wave"></i> </label>
                    <input type="number" name = "total" class = "total form-control @error('total') is-invalid @enderror" value = "{{ $student_invoice->total }}" placeholder="{{__('accounts.total')}}">
                    @error('total')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                {{-- discount --}}
                <div class="form-group">
                    <label for="discount">{{__('accounts.discount')}} <i class = " fas fa-money-bill-wave"></i> </label>
                    <input type="number" name = "discount" class = "form-control @error('discount') is-invalid @enderror" value = "{{ $student_invoice->discount }}" placeholder="{{__('accounts.discount')}}">
                    @error('discount')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                

                {{-- discount type --}}
                <div class="form-group">
                    <label for="discount_type">{{__('accounts.discount_type')}} <i class = " fas fa-money-bill-wave"></i> </label>

                    <select name="discount_type" class = "form-control select2 select2-modal  @error('discount_type') is-invalid @enderror" >
                        <option value="">{{__('accounts.discount_type')}}</option>
                        <option value="fixed" {{$student_invoice->discount_type == 'fixed' ? 'selected' : ''}} >{{__('accounts.fixed')}}</option>
                        <option value="percentage" {{$student_invoice->discount_type == 'percentage' ? 'selected' : ''}} >{{__('accounts.percentage')}}</option>
                    </select>
                
                    @error('discount_type')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="attachments">{{__('general.attachments.title')}}</label>
                    <input type="file" name = "attachments[]" class = "form-control @error('attachments') is-invalid @enderror" multiple>
                    @error('attachments')
                    <div class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                    @enderror
                </div>  

                <div class="form-group mb-1">
                    <label for="notes">{{__('general.notes')}}</label>
                    <textarea type="notes" name = "notes" class = "form-control">{{ $student_invoice->notes }}</textarea>
                </div>
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-dark waves-effect waves-light">{{__('general.edit')}}</button>
            </div>
         </form>
        </div>
    </div>
 </div>
