   <!--primary theme Modal -->
   <div class="modal fade " id="edit_financial_bond_modal_{{$financial_bond->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-light" id="myModalLabel160">
                    {{__('accounts.financial_bonds.edit')}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('dashboard.financial_bond.update' , $financial_bond->id )}}" method = "post" enctype="multipart/form-data" >
                 @csrf
                @method('put')

               

                 <div class="form-group mb-1">
                    <label for="amount">{{__('general.amount')}}</label>
                    <input type="number" name = "amount" class = "form-control" value = "{{$financial_bond->amount}}" required>
                </div>


                <div class="form-group mb-1">
                    <label for="notes">{{__('general.notes')}}</label>
                    <textarea type="notes" name = "notes" class = "form-control">{{$financial_bond->notes}}</textarea>
                </div>

                <div class="form-group mb-1">
                    <label for="attachments">{{__('general.attachments.title')}}</label>
                    <input type="file" name = "attachments[]" class = "form-control" multiple>
                </div>
                              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">{{__('general.close')}}</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">{{__('general.edit')}}</button>
            </div>
         </form>
        </div>
    </div>
 </div>