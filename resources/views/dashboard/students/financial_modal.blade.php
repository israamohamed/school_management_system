   <!--primary theme Modal -->
   <div class="modal fade " id="financial_modal_{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-light" id="myModalLabel160">
                    {{__('accounts.financial_bonds.create')}} :  {{$student->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.financial_bond.store')}}" method = "post" enctype="multipart/form-data" >
                 @csrf

                 <input type="hidden" name = "student_id" value = "{{$student->id}}">

                 <div class="form-group mb-1">
                     <label for="type">{{__('accounts.financial_bonds.type')}}</label>

                     <select name="type" class = "form-select mb-1 select2-modal">
                        <option value="catch" {{old('type') == 'catch' ? 'selected' : ''}} >{{__('accounts.catch')}}</option>
                        <option value="expense" {{old('type') == 'expense' ? 'selected' : ''}} >{{__('accounts.expense')}}</option>  
                        <option value="processing" {{old('type') == 'processing' ? 'selected' : ''}} >{{__('accounts.processing')}}</option>    
                    </select>
                 </div>

                 <div class="form-group mb-1">
                    <label for="amount">{{__('general.amount')}}</label>
                    <input type="number" name = "amount" class = "form-control" value = "{{old('amount')}}" required>
                </div>

                <div class="form-group mb-1">
                    <label for="date">{{__('general.date')}}</label>
                    <input type="date" name = "date" class = "form-control" value = "{{old('date') ?? date("Y-m-d")}}">
                </div>

                <div class="form-group mb-1">
                    <label for="notes">{{__('general.notes')}}</label>
                    <textarea type="notes" name = "notes" class = "form-control">{{old('notes')}}</textarea>
                </div>

                <div class="form-group mb-1">
                    <label for="attachments">{{__('general.attachments.title')}}</label>
                    <input type="file" name = "attachments[]" class = "form-control" multiple>
                </div>
                
                 


                
              
             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-dark waves-effect waves-light">{{__('general.add')}}</button>
            </div>
         </form>
        </div>
    </div>
 </div>