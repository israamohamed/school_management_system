@extends('dashboard.master')

@section('title' , __('accounts.student_invoices.title'))

@section('breadcrumb')
    <h4 class="mb-sm-0">{{__('accounts.student_invoices.title')}}</h4>

    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{__('general.home')}}</a></li>
            <li class="breadcrumb-item active">{{__('accounts.student_invoices.title')}}</li>
        </ol>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title mb-3">
                    <h4 class = "float-start">{{__('accounts.student_invoices.title')}}</h4>
                    <a class = "btn btn-primary waves-effect waves-light float-end" href="{{route('dashboard.student_invoice.create' , ['students' => 'students_data'])}}">{{__('general.add')}}</a>
                   
                    <div class="clearfix"></div>
                </div>
                @if(count($student_invoices) > 0)
                    <div class="table-responsive mb-2">
                        <table class="table table-bordered mb-0">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('accounts.invoice_date')}}</th>
                                    <th>{{__('students.one')}}</th>
                                    <th>{{__('accounts.study_fees.title')}}</th>
                                    <th>{{__('accounts.total')}}</th>
                                    <th>{{__('accounts.discount')}}</th>
                                    <th>{{__('accounts.final_total')}}</th>
                                    <th>{{__('general.notes')}}</th>
                                    <th>{{__('general.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student_invoices as $student_invoice)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$student_invoice->invoice_date}}</td>
                                    <td class = "text-center">
                                        @php $student = $student_invoice->student  @endphp
                                        @if($student)
                                            <button class = "btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#show_modal_{{$student->id}}"> {{$student->name}}</button>
                                            @include('dashboard.students.show_modal')
                                        @endif           
                                    </td>
                                   

                                    <td>{{$student_invoice->study_fee ? $student_invoice->study_fee->title : '--'}}</td>
                                    <td><span style = "font-size: 1.1em;">{{$student_invoice->total}}</span></td>
                                    <td>
                                        @if($student_invoice->discount)
                                            <span class = "badge bg-success rounded-pill" style = "font-size: 1.1em;">{{$student_invoice->discount}}   {{$student_invoice->discount_type == 'percentage' ? '%' : ''}} </span>
                                        @else 
                                        @endif
                                    </td>

                                    <td><span class = "text-danger" style = "font-size: 1.1em;font-weight:bold;">{{$student_invoice->final_total}}</span></td>
                                   
                                    <td>{{Str::limit($student_invoice->notes , 30)}}</td>
                                    
                                    <td>
                                        <button class = "btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit_student_invoice_modal_{{$student_invoice->id}}"><i class = "fas fa-edit"></i></button>
                                        @include('dashboard.student_invoices.edit')
            
                                        <button class = "btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_student_invoice_modal_{{$student_invoice->id}}"><i class = "fas fa-trash"></i></button>
                                        @include('dashboard.student_invoices.delete')
                                       
                                    </td>
                                </tr>
                                @endforeach            
                            </tbody>
                        </table>
                    </div>
                {{$student_invoices->links()}}
                @else 
                    <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection