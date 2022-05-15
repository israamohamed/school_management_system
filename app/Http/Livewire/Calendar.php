<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    public $events = '';

    public function getevent()
    {       
        $this->events = Event::select('id','title','start')->get();

        return  json_encode($this->events);
    }

    /**
    * Write code on Method
    *
    * @return response()
    */ 
    public function addevent($event)
    {
        $input['title'] = $event['title'];
        $input['start'] = date("Y-m-d" , strtotime($event['start']));
        $new_event = Event::create($input);
        //$this->events =  Event::select('id','title','start')->get();
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function eventDrop($event, $oldEvent)
    {
      if(isset($event['id']))
      {
        $eventdata = Event::find($event['id']);
      }
      else 
      {
          $eventdata = Event::where('title' , $oldEvent['title'])->whereDate('start' , $oldEvent['start'] )->latest()->first();
      }
      if($eventdata)
      {
        $eventdata->start = $event['start'];
        $eventdata->save();
      }
     
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function render()
    {       
        $events = Event::select('id','title','start')->get();

        $this->events = json_encode($events);

        return view('livewire.calendar');
    }

}
