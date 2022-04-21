<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EducationalStage;
use App\Models\ClassRoom;
use App\Models\EducationalClassRoom;

class EducationalClassRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educational_stages = EducationalStage::get();
        foreach($educational_stages as $educational_stage)
        {
            $counter = 0;
            foreach($educational_stage->class_rooms as $class_room)
            {
                $counter++;

                for($i = 0; $i<3; $i++)
                {
                    $name =  ($i+1) . '/' . $counter ;
                    EducationalClassRoom::create([
                        'name' => ['en' => $name , 'ar' => $name],
                        'number_of_students' => ($i + 20),
                        'class_room_id' => $class_room->id
                    ]);
                }
            }
        }
    }
}
