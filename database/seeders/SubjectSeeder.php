<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EducationalStage;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            ['en' => 'Arabic' , 'ar' => 'لغة عربية'],
            ['en' => 'English' , 'ar' => 'لغة إنجليزية'],
            ['en' => 'Mathmatics'    , 'ar' => 'رياضيات'],
            ['en' => 'Relision' , 'ar' => 'دين'],
            ['en' => 'Computer' , 'ar' => 'حاسب آلي'],
            ['en' => 'Social Studies' , 'ar' => 'دراسات اجتماعية'],
            ['en' => 'Science' , 'ar' => 'علوم'],
        ];

        $educational_stages = EducationalStage::get();

        $counter = 0;
        foreach($educational_stages as $educational_stage)
        {
            foreach($educational_stage->class_rooms as $class_room)
            {
                for($i = 0; $i<count($names); $i++)
                {
                    \Log::debug($class_room->getTranslation('name' , 'en'));
                    \Log::debug("in_array( class_room->getTranslation('name' , 'en') , ['Class 4' , 'Class 5' , 'Class 6'] )");
                    \Log::debug(in_array( $class_room->getTranslation('name' , 'en') , ['Class 4' , 'Class 5' , 'Class 6'] ));
                    \Log::debug("names[i]['en']");
                    \Log::debug($names[$i]['en']);


                    if( !in_array( $class_room->getTranslation('name' , 'en') , ['Class 4' , 'Class 5' , 'Class 6'] ) &&   (  $names[$i]['en'] == 'Science' || $names[$counter]['en'] ==  'Social Studies')   )
                    {
                        continue;
                    }
                    else 
                    {
                        Subject::create([
                            'name'                 => $names[$i],
                            'class_room_id'        => $class_room->id,
                            'upper_grade'          => 100,
                            'lower_grade'          => 50,
                            'main_subject'         => 1,
                            'success_required'     => 1 ,
                            'shared_between_terms' => 1,
                        ]);
                    }
                    
                }

                //$counter++;
            }
        }
    }
}
