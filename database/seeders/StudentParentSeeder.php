<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Relision;
use App\Models\StudentParent;

class StudentParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parent = StudentParent::create([
            'father_name'            => ['en' => 'Ahmed Mohamed' , 'ar' => 'أحمد محمد'],
            'father_national_id'     => '545151415120',
            'father_passport_number' => '',
            'father_phone_number'    => '01145559999',
            'father_job'             => 'tearcher',
            'father_blood_type_id'   => BloodType::first()->id,
            'father_nationality_id'  => Nationality::first()->id,
            'father_relision_id'     => Relision::first()->id,
            'father_address'         => 'Maadi',

            'mother_name'            => ['en' => 'Nadia Ahmed Ali', 'ar' => 'نادية أحمد علي'],
            'mother_national_id'     => '120154121251515',
            'mother_passport_number' => '',
            'mother_phone_number'    => '01148899666',
            'mother_job'             => 'teacher',
            'mother_blood_type_id'   => BloodType::skip(1)->first()->id,
            'mother_nationality_id'  => Nationality::first()->id,
            'mother_relision_id'     => Relision::first()->id,
            'mother_address'         => 'Maadi',  

            'email'                  => 'nadia@gmail.com',
            'password'               => '123456',
        ]);



        $parent = StudentParent::create([
            'father_name'            => ['en' => 'Sayed Mohamed' , 'ar' => 'سيد محمد'],
            'father_national_id'     => '140051415120',
            'father_passport_number' => '0251451202154545',
            'father_phone_number'    => '01121059999',
            'father_job'             => 'doctor',
            'father_blood_type_id'   => BloodType::skip(2)->first()->id,
            'father_nationality_id'  => Nationality::skip(5)->first()->id,
            'father_relision_id'     => Relision::first()->id,
            'father_address'         => 'El-Haram',

            'mother_name'            => ['en' => 'Salma Sayed Ali', 'ar' => 'سلمى سيد علي'],
            'mother_national_id'     => '129900001251515',
            'mother_passport_number' => '',
            'mother_phone_number'    => '01140999666',
            'mother_job'             => 'teacher',
            'mother_blood_type_id'   => BloodType::skip(2)->first()->id,
            'mother_nationality_id'  => Nationality::skip(5)->first()->id,
            'mother_relision_id'     => Relision::first()->id,
            'mother_address'         => 'El-Haram',  

            'email'                  => 'salma@gmail.com',
            'password'               => '123456',
        ]);
    }
}
