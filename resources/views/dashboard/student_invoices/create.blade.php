@extends('dashboard.master')

@section('title' , __('accounts.student_invoices.create'))

@push('styles')

   
@endpush
@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('accounts.student_invoices.create')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('dashboard.student_invoice.index')}}">{{__('accounts.student_invoices.title')}}</a></li>
            <li class="breadcrumb-item active">{{__('accounts.student_invoices.create')}}</li>
        </ol>
    </div>
@endsection

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('accounts.student_invoices.create')}}</h4>
                    <div class="clearfix"></div>
                </div>


                    <form action="{{route('dashboard.student_invoice.store')}}" method = "post" enctype="multipart/form-data" class="repeater">
                        @csrf


                        @if(isset($student))
                            <p class = "bg-info bg-gradient p-2 text-center fw-bold text-white rounded" style = "font-size:1.5em;">{{__('accounts.add_invoice_to' , ['name' => $student->name])}}</p>
                            <input type="hidden" name = "student_id" value = "{{$student->id}}">
                        @endif


                        <button type = "button"  data-repeater-create class="btn btn-success rounded waves-effect waves-light">{{__('accounts.add_another_invoice')}}</button>
                    
                        <br><br>
                        <div class = "clearfix"></div>
                        
                        <div  data-repeater-list="invoices">

                            @if(old('invoices'))
                            @foreach( old('invoices') as $invoice )
                                <div class="row mb-3" data-repeater-item>

                                    <div class="col-md-3 study_fee_parent">
                                        {{-- study fee --}}
                                        <div class="form-group">
                                            <label for="study_fee_id">{{__('accounts.study_fees.one')}}</label>
                                            <select name="study_fee_id" class = "study_fee form-control select2 @error('study_fee_id') is-invalid @enderror" onchange="changing_amount(this)">
                                                <option value="">{{__('accounts.study_fees.select')}}</option>
                                                @foreach($study_fees as $study_fee)
                                                    <option value="{{$study_fee->id}}" data-amount = "{{$study_fee->amount}}" {{ $invoice['study_fee_id'] == $study_fee->id ? 'selected' : ''}} >{{$study_fee->title}}</option>
                                                @endforeach       
                                            </select>
                                            @error('study_fee_id')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>        
                                    </div>
        
                                    <div class="col-md-2 total_parent">
                                        {{-- total --}}
                                        <div class="form-group">
                                            <label for="total">{{__('accounts.total')}} <i class = " fas fa-money-bill-wave"></i> </label>
                                            <input type="number" name = "total" class = "total form-control @error('total') is-invalid @enderror" value = "{{$invoice['total']}}" placeholder="{{__('accounts.total')}}">
                                            @error('total')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
        
        
                                    <div class="col-md-2">
                                        {{-- discount --}}
                                        <div class="form-group">
                                            <label for="discount">{{__('accounts.discount')}} <i class = " fas fa-money-bill-wave"></i> </label>
                                            <input type="number" name = "discount" class = "form-control @error('discount') is-invalid @enderror" value = "{{$invoice['discount']}}" placeholder="{{__('accounts.discount')}}">
                                            @error('discount')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-md-2">
                                        {{-- discount type --}}
                                        <div class="form-group">
                                            <label for="discount_type">{{__('accounts.discount_type')}} <i class = " fas fa-money-bill-wave"></i> </label>
        
                                            <select name="discount_type"class = "form-control select2 @error('discount_type') is-invalid @enderror" >
                                                <option value="">{{__('accounts.discount_type')}}</option>
                                                <option value="fixed" {{ $invoice['discount_type'] == 'fixed' ? 'selected' : '' }}  >{{__('accounts.fixed')}}</option>
                                                <option value="percentage" {{ $invoice['discount_type'] == 'percentage' ? 'selected' : '' }}>{{__('accounts.percentage')}}</option>
                                            </select>
                                        
                                            @error('discount_type')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="attachments">{{__('general.attachments.title')}}</label>
                                            <input type="file" name = "attachments" class = "form-control @error('attachments') is-invalid @enderror" multiple>
                                            @error('attachments')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>  
                                    </div>

                                    

                                    <div class="col-md-1">
                                        <label> <i class = "fas fa-trash"></i> </label>
                                        <button class = "btn btn-danger form-control" data-repeater-delete type = "button">{{__('general.delete')}}</button>
                                    </div>
        
                                                            
                                </div>
                            @endforeach

                            @else 
                                <div class="row mb-3" data-repeater-item>

                                    <div class="col-md-3 study_fee_parent">
                                        {{-- study fee --}}
                                        <div class="form-group">
                                            <label for="study_fee_id">{{__('accounts.study_fees.one')}}</label>
                                            <select name="study_fee_id" class = "study_fee form-control select2 @error('study_fee_id') is-invalid @enderror" onchange="changing_amount(this)">
                                                <option value="">{{__('accounts.study_fees.select')}}</option>
                                                @foreach($study_fees as $study_fee)
                                                    <option value="{{$study_fee->id}}" data-amount = "{{$study_fee->amount}}" {{old('study_fee_id') == $study_fee->id ? 'selected' : ''}} >{{$study_fee->title}}</option>
                                                @endforeach       
                                            </select>
                                            @error('study_fee_id')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>        
                                    </div>
        
                                    <div class="col-md-2 total_parent">
                                        {{-- total --}}
                                        <div class="form-group">
                                            <label for="total">{{__('accounts.total')}} <i class = " fas fa-money-bill-wave"></i> </label>
                                            <input type="number" name = "total" class = "total form-control @error('total') is-invalid @enderror" value = "{{old('total')}}" placeholder="{{__('accounts.total')}}">
                                            @error('total')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
        
        
                                    <div class="col-md-2">
                                        {{-- discount --}}
                                        <div class="form-group">
                                            <label for="discount">{{__('accounts.discount')}} <i class = " fas fa-money-bill-wave"></i> </label>
                                            <input type="number" name = "discount" class = "form-control @error('discount') is-invalid @enderror" value = "{{old('discount')}}" placeholder="{{__('accounts.discount')}}">
                                            @error('discount')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="col-md-2">
                                        {{-- discount type --}}
                                        <div class="form-group">
                                            <label for="discount_type">{{__('accounts.discount_type')}} <i class = " fas fa-money-bill-wave"></i> </label>
        
                                            <select name="discount_type"class = "form-control select2 @error('discount_type') is-invalid @enderror" >
                                                <option value="">{{__('accounts.discount_type')}}</option>
                                                <option value="fixed">{{__('accounts.fixed')}}</option>
                                                <option value="percentage">{{__('accounts.percentage')}}</option>
                                            </select>
                                        
                                            @error('discount_type')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="attachments">{{__('general.attachments.title')}}</label>
                                            <input type="file" name = "attachments" class = "form-control @error('attachments') is-invalid @enderror" multiple>
                                            @error('attachments')
                                            <div class="invalid-feedback d-block">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>  
                                    </div>

                                    

                                    <div class="col-md-1">
                                        <label> <i class = "fas fa-trash"></i> </label>
                                        <button class = "btn btn-danger form-control" data-repeater-delete type = "button">{{__('general.delete')}}</button>
                                    </div>
        
                                                            
                                </div>
                            @endif
                        </div>



                        <div class="row">

                            <div class="col-md-6">
                                {{-- invoice_date  --}}
                                <div class="form-group">
                                    <label for="invoice_date">{{__('accounts.invoice_date')}}</label>
                                    <input type="date" name = "invoice_date" class = "form-control" value = "{{old('invoice_date') ?? date("Y-m-d") }}">
                                </div>                
                            </div>

                            <div class="col-md-6">
                                {{-- notes  --}}
                                <div class="form-group">
                                    <label for="notes">{{__('general.notes')}}</label>
                                    <input type="text" name = "notes" class = "form-control" value = "{{old('notes')}}">
                                </div>                
                            </div>
    
                        </div>
                       

                        
                        <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light float-end my-4">
                            <i class="ri-check-line align-middle me-2"></i>
                            {{__('general.add')}}
                        </button>

                    </form>
                    
                </div>
             

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script src="{{asset('dashboard/assets/js/jquery.repeater.js')}}"></script>
    
<script>
        $(document).ready(function() {

        $(".select2").select2();


        $('.repeater').repeater({
        // (Optional)
        // start with an empty list of repeaters. Set your first (and only)
        // "data-repeater-item" with style="display:none;" and pass the
        // following configuration flag
        initEmpty: false,
        // (Optional)
        // "defaultValues" sets the values of added items.  The keys of
        // defaultValues refer to the value of the input's name attribute.
        // If a default value is not specified for an input, then it will
        // have its value cleared.
        defaultValues: {
            'text-input': 'foo'
        },
        // (Optional)
        // "show" is called just after an item is added.  The item is hidden
        // at this point.  If a show callback is not given the item will
        // have $(this).show() called on it.
        show: function () {
            
            $('.select2-container').remove();
            $(".select2").select2();
            $('.select2-container').css('width','100%');
            $(this).slideDown();
            
        },
        // (Optional)
        // "hide" is called when a user clicks on a data-repeater-delete
        // element.  The item is still visible.  "hide" is passed a function
        // as its first argument which will properly remove the item.
        // "hide" allows for a confirmation step, to send a delete request
        // to the server, etc.  If a hide callback is not given the item
        // will be deleted.
        hide: function (deleteElement) {
            if(confirm('Are you sure you want to delete this element?')) {
                $(this).slideUp(deleteElement);
            }
        },
        // (Optional)
        // You can use this if you need to manually re-index the list
        // for example if you are using a drag and drop library to reorder
        // list items.
        /*ready: function (setIndexes) {
            $dragAndDrop.on('drop', setIndexes);
        },*/
        // (Optional)
        // Removes the delete button from the first list item,
        // defaults to false.
        isFirstItemUndeletable: true
    })
});

    
</script>

<script>

    function changing_amount(select)
    {
        var amount = $(select).find(':selected').data('amount');
        console.log($(select).closest(".study_fee_parent").next().find('.total').val(amount));
    }

</script>

@endpush