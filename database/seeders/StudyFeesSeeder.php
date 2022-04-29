<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudyFeeItem;
use App\Models\StudyFee;
use App\Models\EducationalStage;

class StudyFeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item1 = StudyFeeItem::create([
            'name' => ['en' => 'School expenses' , 'ar' => 'مصاريف المدرسة'],
            'type' => 'mandatory',
        ]);

        $item2 = StudyFeeItem::create([
            'name' => ['en' => 'Books expenses' , 'ar' => 'مصاريف الكتب'],
            'type' => 'mandatory',
        ]);

        $item3 = StudyFeeItem::create([
            'name' => ['en' => 'Trips' , 'ar' => 'الرحلات'],
            'type' => 'optional',
        ]);

        $item4 = StudyFeeItem::create([
            'name' => ['en' => 'Buses' , 'ar' => 'الباصات'],
            'type' => 'optional',
        ]);


        $educational_stages = EducationalStage::get();

        $study_fee_items_mandatory = StudyFeeItem::where('type' , 'mandatory')->get();
        $study_fee_items_optional = StudyFeeItem::where('type' , 'optional')->get();


        $i = 1;

        foreach($educational_stages as $educational_stage)
        {
            foreach($educational_stage->class_rooms as $class_room)
            {
                foreach($study_fee_items_mandatory as $study_fee_item)
                {
                    
                    $i++;
                    StudyFee::create([
                        'title'                =>  [
                            'en' => $study_fee_item->getTranslation('name' , 'en') . ' ' . $educational_stage->getTranslation('name' , 'en') . ' ' . $class_room->getTranslation('name' , 'en')  ,
                            'ar' => $study_fee_item->getTranslation('name' , 'ar') . ' ' . $educational_stage->getTranslation('name' , 'ar') . ' ' . $class_room->getTranslation('name' , 'ar')  ,
                        ],
                        'study_fee_item_id'    => $study_fee_item->id ,
                        'educational_stage_id' => $educational_stage->id,
                        'class_room_id'        => $class_room->id,
                        'academic_year'        => '2022',
                        'amount'               => $i * 500 ,
                    ]);
                }
                
            }
        }


        $i = 0;
        foreach($study_fee_items_optional as $study_fee_item)
        {
            $i++;
            StudyFee::create([
                'title'                =>  $study_fee_item->getTranslation('name' , 'en') . '2022' ,
                'study_fee_item_id'    => $study_fee_item->id ,
                'academic_year'        => '2022',
                'amount'               => $i * 500 ,
            ]);
        }



    }
}
