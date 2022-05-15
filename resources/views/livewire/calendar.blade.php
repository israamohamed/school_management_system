<style>
    #calendar-container{
        width: 100%;
    }
    #calendar{
        padding: 10px;
        margin-bottom: 10px;
        /* width: 1340px; */
        width: 100%;
        /* height: 610px; */
        border:2px solid #2878a780;
        background: #fff;
    }
</style>

<div>
  <div id='calendar-container' wire:ignore>
    <div id='calendar'></div>
  </div>
</div>

@include('livewire.events.script')
@push('scripts')
    {{-- <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script> --}}
    
    <script>
        document.addEventListener('livewire:load', function() {
            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;
            var calendarEl = document.getElementById('calendar');
            var checkbox = document.getElementById('drop-remove');
            var data =   @this.events;
            var calendar = new Calendar(calendarEl, {
            events: JSON.parse(data),
            dateClick(info)  {

         
                Swal.fire({
                    title: "{{__('general.enter_event_title')}}",
                    input: "text",
                    showCancelButton: false,
                    confirmButtonText: "{{__('general.add')}}",
                    showLoaderOnConfirm: true,
                    // confirmButtonColor: "#038a98",
                    cancelButtonColor: "#e66060",

                    preConfirm: function (n) {
                        if(!n)
                        {
                            Swal.fire({
                                icon: "error",
                                title: "{{__('general.event_name_is_required')}}",
                                confirmButtonColor: "#038a98",
                            });
                        }
                    },
                    allowOutsideClick: true,
                    }).then(function (t) {
                        if(t.value)
                        {
                            var date = new Date(info.dateStr + 'T00:00:00');
                            var title = t.value;
                            
                            calendar.addEvent({
                                title: title,
                                start: date,
                                allDay: true
                            });

                            var eventAdd = {title: title , start: date};
                            
                            @this.addevent(eventAdd);
                            Swal.fire({
                                icon: "success",
                                title: "{{__('general.event_is_created_successfully')}}",                          
                                timer: 2000,
                            });
                        }
                        
                    });

               
               
               /*if(title != null && title != ''){
                 calendar.addEvent({
                    title: title,
                    start: date,
                    allDay: true
                  });
                 var eventAdd = {title: title,start: date};
                 @this.addevent(eventAdd);
                 alert('Great. Now, update your database...');
               }else{
                alert('Event Title Is Required');
               }*/
            },
            editable: true,
            selectable: true,
            displayEventTime: false,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                // if so, remove the element from the "Draggable Events" list
                info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            },
            eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
            loading: function(isLoading) {
                    if (!isLoading) {
                        // Reset custom events
                        this.getEvents().forEach(function(e){
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                }
            });
            calendar.render();
            @this.on(`refreshCalendar`, () => {
                calendar.refetchEvents()
            });
        });
    </script>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
@endpush