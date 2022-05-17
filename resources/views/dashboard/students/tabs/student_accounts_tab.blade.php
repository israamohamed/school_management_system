<div class="tab-pane" id="student_accounts" role="tabpanel">
    <p class="mb-0">

     

        <div class="">
            <div class="">

                <div class="card-title bg-danger bg-gradient rounded text-center p-2 mb-1">
                    <h2 class = "text-white">{{__('students.student_balance')}} : {{$student->balance}} </h2>
                </div>

        
                <ul class="nav nav-tabs nav-justified" role="tablist">
                    @can('show.student_invoices')
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-bs-toggle="tab" href="#invoices" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">{{__('accounts.student_invoices.title2')}}</span>   
                            </a> 
                        </li>  
                    @endcan

                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#transactions" role="tab">
                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-block">{{__('accounts.student_tranactions.title2')}}</span>   
                        </a> 
                    </li>  

                    @can('show.financial_bonds')
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-bs-toggle="tab" href="#financial_bonds" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">{{__('accounts.financial_bonds.title')}}</span>   
                            </a> 
                        </li> 
                    @endcan
                </ul>

                <div class="tab-content text-muted">

                    @can('show.student_invoices')
                        @include('dashboard.students.tabs.invoices_tab')
                    @endcan
                    @include('dashboard.students.tabs.transactions_tab')

                    @can('show.financial_bonds')
                        @include('dashboard.students.tabs.financial_bonds_tab')
                    @endcan
                
                </div>
            </div>
        </div>


    </p>
</div>
