<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AbsenceReason;

class AbsenceReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AbsenceReason::create([
            'name' => ['en' => 'Undefined' , 'ar' => 'غير محدد'],
        ]);

        AbsenceReason::create([
            'name' => ['en' => 'sick' , 'ar' => 'مرضي'],
        ]);

        AbsenceReason::create([
            'name' => ['en' => 'emergency cause' , 'ar' => 'سبب طارئ'],
        ]);
    }
}
