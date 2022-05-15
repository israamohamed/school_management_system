@extends('dashboard.master')

@push('styles')
<style>
    .more_info 
    {
        display: none;
    }
</style>
@endpush

@section('title' , 'Home')

@section('content')
<div class="card-body">
    
    {{-- @livewire('events-calendar') --}}
    <div class="row">

        <div class="col-lg-5">
            {{--statistics --}}
            <div class="row">

                {{--students --}}   {{--#205c7e --}} {{--#2878a780--}}
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-center shadow-lg" style = "background:#205c7e">
                        <a href="{{route('dashboard.student.index')}}">
                            <div class="card-body">
                                <h4 class="card-title text-light">{{__('reports.students_count')}}</h4>
                                <h2 class="mt-3 mb-2" style = "font-size: 3em;color:#fff"><i class="fas fa-user-friends text-light me-2"></i><b>{{ $students_count }}</b>
                                </h2>
                                <p class=" mb-0 mt-3 more_info" style = "background:#2878a780"><a style = "color:#fff;" href="{{route('dashboard.student.index')}}">{{__('general.more_info')}}  <i class = " fas fa-angle-double-right text-light"></i>  </a></p>
                            </div>
                        </a>

                    </div>
                </div>


                {{-- graudated students --}}   {{--#205c7e --}} {{--#2878a780--}}
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-center shadow-lg" style = "background:#2878a780">
                        <a href="{{route('dashboard.graduated_student.index')}}">
                            <div class="card-body">
                                <h4 class="card-title" style = "color:#205c7e;">{{__('reports.graduated_students_count')}}</h4>
                                <h2 class="mt-3 mb-2" style = "font-size: 3em;color:#205c7e"><i class="fas fa-user-graduate me-2" style = "color:#205c7e;"></i><b>{{ $graduated_students_count }}</b>
                                </h2>
                                <p class=" mb-0 mt-3 more_info" style = "background:#205c7e"><a style = "color:#fff;" href="{{route('dashboard.graduated_student.index')}}">{{__('general.more_info')}}  <i class = " fas fa-angle-double-right" style = "color:#205c7e;"></i>  </a></p>
                            </div>
                        </a>
                    </div>
                </div>


                {{--educational_class_rooms_count --}}   {{--#205c7e --}} {{--#2878a780--}}
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-center shadow-lg" style = "background:#205c7e">
                        <a href="{{route('dashboard.educational_class_room.index')}}">
                            <div class="card-body">
                                <h4 class="card-title text-light">{{__('reports.educational_class_rooms_count')}}</h4>
                                <h2 class="mt-3 mb-2" style = "font-size: 3em;color:#fff"><i class="fas fa-layer-group text-light me-2"></i><b>{{ $educational_class_rooms_count }}</b>
                                </h2>
                                <p class=" mb-0 mt-3 more_info" style = "background:#2878a780"><a style = "color:#fff;" href="{{route('dashboard.educational_class_room.index')}}">{{__('general.more_info')}}  <i class = " fas fa-angle-double-right text-light"></i>  </a></p>
                            </div>
                        </a>
                    </div>
                </div>


                {{-- students_invoices_count --}}   {{--#205c7e --}} {{--#2878a780--}}
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-center shadow-lg" style = "background:#2878a780">
                        <a href="{{route('dashboard.student_invoice.index')}}">
                            <div class="card-body">
                                <h4 class="card-title" style = "color:#205c7e;">{{__('reports.students_invoices_count')}}</h4>
                                <h2 class="mt-3 mb-2" style = "font-size: 3em;color:#205c7e"><i class="fas fa-file-invoice-dollar me-2" style = "color:#205c7e;"></i><b>{{ $students_invoices_count }}</b>
                                </h2>
                                <p class=" mb-0 mt-3 more_info" style = "background:#205c7e"><a style = "color:#fff;" href="{{route('dashboard.student_invoice.index')}}">{{__('general.more_info')}}  <i class = " fas fa-angle-double-right" style = "color:#205c7e;"></i>  </a></p>
                            </div>
                        </a>
                    </div>
                </div>


                {{--teachers_count --}}   {{--#205c7e --}} {{--#2878a780--}}
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-center shadow-lg" style = "background:#205c7e">
                        <a href="{{route('dashboard.teacher.index')}}">
                            <div class="card-body">
                                <h4 class="card-title text-light">{{__('reports.teachers_count')}}</h4>
                                <h2 class="mt-3 mb-2" style = "font-size: 3em;color:#fff"><i class="fas fa-chalkboard-teacher text-light me-2"></i><b>{{ $teachers_count }}</b>
                                </h2>
                                <p class=" mb-0 mt-3 more_info" style = "background:#2878a780"><a style = "color:#fff;" href="{{route('dashboard.teacher.index')}}">{{__('general.more_info')}}  <i class = " fas fa-angle-double-right text-light"></i>  </a></p>
                            </div>
                        </a>
                    </div>
                </div>
                
                
                {{-- students_parents_count --}}   {{--#205c7e --}} {{--#2878a780--}}
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-center shadow-lg" style = "background:#2878a780">
                        <a href="{{route('dashboard.student_parent.index')}}">
                            <div class="card-body">
                                <h4 class="card-title" style = "color:#205c7e;">{{__('reports.students_parents_count')}}</h4>
                                <h2 class="mt-3 mb-2" style = "font-size: 3em;color:#205c7e"><i class="fas fa-user-tie me-2" style = "color:#205c7e;"></i><b>{{ $students_parents_count }}</b>
                                </h2>
                                <p class=" mb-0 mt-3 more_info" style = "background:#205c7e"><a style = "color:#fff;" href="{{route('dashboard.student_parent.index')}}">{{__('general.more_info')}}  <i class = " fas fa-angle-double-right" style = "color:#205c7e;"></i>  </a></p>
                            </div>
                        </a>
                    </div>
                </div>
                

            </div>
        </div>
        <div class="col-lg-7">
            @livewire('calendar')
        </div>
    </div>
    

 
    
    {{-- recents students --}}

    
    <div class="row">
        {{--latest students --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3">
                        <h4 class = "float-start">{{__('reports.latest_students')}} </h4>                 
                        <div class="clearfix"></div>
                    </div>

                
                    @if(count($latest_students) > 0)
                        <div class="table-responsive mb-2" style = "height: 300px;">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('general.created_at')}}</th>
                                        <th>{{__('general.name')}}</th>   
                                        <th>{{__('general.class_rooms.one')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latest_students as $student)
                                    <tr>
                                        
                                        <td class="text-bold-500">{{$loop->iteration}}</td>
                                        <td>{{$student->date}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>
                                            {{$student->educational_stage() ? $student->educational_stage()->name : '--'}} -
                                            {{$student->class_room ? $student->class_room->name : '--'}}
                                        </td>
                                        
                                    
                                    </tr>               
                                    @endforeach            
                                </tbody>
                            </table>
                        </div>
                    @else 
                        <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                    @endif
                    
                </div>
            </div>
        </div>

        {{-- latest student invoices --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title mb-3">
                        <h4 class = "float-start">{{__('reports.latest_student_invoices')}} </h4>                 
                        <div class="clearfix"></div>
                    </div>

                
                    @if(count($latest_student_invoices) > 0)
                        <div class="table-responsive mb-2" style = "height: 300px;">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('accounts.invoice_date')}}</th>
                                       
                                        <th>{{__('accounts.study_fees.title')}}</th>
                                       
                                        <th>{{__('accounts.final_total')}}</th>
                                     
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latest_student_invoices as $student_invoice)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$student_invoice->invoice_date}}</td>
                                      
    
                                        <td>{{$student_invoice->study_fee ? $student_invoice->study_fee->title : '--'}}</td>

    
                                        <td><span class = "text-danger" style = "font-size: 1.1em;font-weight:bold;">{{$student_invoice->final_total}}</span></td>
                                        
                                    
                                    </tr>               
                                    @endforeach            
                                </tbody>
                            </table>
                        </div>
                    @else 
                        <p class="text-danger" style = "font-size:1.5em;"> {{__('messages.no_data')}}</p>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    
  
</div>
@endsection