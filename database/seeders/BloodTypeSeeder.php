<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BloodType;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blood_types')->delete();
        $blood_types = [
            ['name' => 'O-'] , 
            ['name' => 'O+'] , 
            ['name' => 'A+'] , 
            ['name' => 'A-'] , 
            ['name' => 'B+'] , 
            ['name' => 'B-'] , 
            ['name' => 'AB+'] , 
            ['name' => 'AB-']
        ];
        
       
        BloodType::insert($blood_types);
    }
}
