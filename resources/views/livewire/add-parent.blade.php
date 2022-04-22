<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <div class="clearfix"></div>

    @if($success_message)
        <div class="alert alert-success" role="alert">{{$success_message}}</div>
    @endif

    @if($error_message)
        <div class="alert alert-danger" role="alert">{{$error_message}}</div>
    @endif

    <div class="row">
        <div id="basic-pills-wizard" class="twitter-bs-wizard">
            <ul class="twitter-bs-wizard-nav nav nav-pills nav-justified">
                <li class="nav-item">
                    <a href="#father-form" class="nav-link {{$current_step == 1 ? 'active' : ''}}" data-toggle="tab">
                        <span class="step-number">01</span>
                        <span class="step-title">{{__('student_parents.father_details')}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#mother-form" class="nav-link {{$current_step == 2 ? 'active' : ''}}" data-toggle="tab">
                        <span class="step-number">02</span>
                        <span class="step-title">{{__('student_parents.mother_details')}}</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#confirm-details" class="nav-link {{$current_step == 3 ? 'active' : ''}}" data-toggle="tab">
                        <span class="step-number">03</span>
                        <span class="step-title">{{__('student_parents.confirm_details')}}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content twitter-bs-wizard-tab-content">
                <div class="tab-pane {{$current_step == 1 ? 'active' : ''}}" id="father-form">
                   @include('livewire.parents.father-form')
                </div>
                <div class="tab-pane {{$current_step == 2 ? 'active' : ''}}" id="mother-form">
                    @include('livewire.parents.mother-form')
                </div>
           
                <div class="tab-pane {{$current_step == 3 ? 'active' : ''}}" id="confirm-details">
                    @include('livewire.parents.confirm-details')
                </div>
                
            </div>
            <ul class="pager wizard twitter-bs-wizard-pager-link">
                <li class="previous_style"><a href="javascript: void(0);" wire:click= "back">{{__('general.previous')}}</a></li>
                <li class="next_style"><a href="javascript: void(0);" wire:click = "next">{{__('general.next')}}</a></li>
            </ul>
        </div>
    </div>


                   
               
</div>
