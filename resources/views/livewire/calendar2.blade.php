<div>
    <div class="row mb-4">
        <div class="col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <button type="button" class="btn font-16 btn-primary waves-effect waves-light w-100" id="btn-new-event" data-bs-toggle="modal" data-bs-target="#event-modal"> Create New Event</button>

                    <div id="external-events">
                       @include('livewire.events.external-events')
                    </div>
                    
                </div>
            </div>
        </div> <!-- end col-->
        <div class="col-xl-9">
            <div class="card mb-0">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row-->
    <div style='clear:both'></div>

   @include('livewire.events.add_new_event_modal')
</div>



@push('styles')
<!-- Plugin css -->
<link rel="stylesheet" href="{{asset('dashboard/assets/libs/@fullcalendar/core/main.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('dashboard/assets/libs/@fullcalendar/daygrid/main.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('dashboard/assets/libs/@fullcalendar/bootstrap/main.min.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('dashboard/assets/libs/@fullcalendar/timegrid/main.min.css')}}" type="text/css">
@endpush


@push('scripts')

<!-- plugin js -->
<script src="{{asset('dashboard/assets/libs/moment/min/moment.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/jquery-ui-dist/jquery-ui.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/@fullcalendar/core/main.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/@fullcalendar/bootstrap/main.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/@fullcalendar/daygrid/main.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/@fullcalendar/timegrid/main.min.js')}}"></script>
<script src="{{asset('dashboard/assets/libs/@fullcalendar/interaction/main.min.js')}}"></script>

{{-- <!-- Calendar init -->
<script src="{{asset('dashboard/assets/js/pages/calendar.init.js')}}"></script> --}}

@endpush

@include('livewire.events.calendar_scripts')