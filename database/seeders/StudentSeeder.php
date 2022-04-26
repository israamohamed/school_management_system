<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\StudentParent;
use App\Models\BloodType;
use App\Models\Nationality;
use App\Models\Relision;
use App\Models\EducationalClassRoom;

class StudentSeeder extends Seeder
{
    public $father_names = [];
    public $mother_names = [];
    public $parent_emails = [];
    public $student_names = [];
    public $student_emails = [];
    public $images = [];



    public function __construct()
    {
        $this->father_names = [
            ['en' => 'Ahmed Mohamed' , 'ar' => 'أحمد محمد'],
            ['en' => 'Sayed Mohamed' , 'ar' => 'سيد محمد'],
            ['en' => 'Atef Ahmed'    , 'ar' => 'عاطف أحمد'],
            ['en' => 'Nabil Mohamed' , 'ar' => 'نبيل محمد'],
            ['en' => 'Nader Sayed' , 'ar' => 'نادر سيد'],
            ['en' => 'Sameh Ahmed' , 'ar' => 'سامح أحمد'],
            ['en' => 'Mohamed Helmy' , 'ar' => 'محمد حلمي'],
            ['en' => 'Hussien Hassan' , 'ar' => 'حسين حسن'],
            ['en' => 'Hassan Sayed' , 'ar' => 'حسن سيد'],
            ['en' => 'AbdElrahman Mohamed' , 'ar' => 'عبد الرحمن محمد'],    
        ];

        $this->mother_names = [
            ['en' => 'Nadia Ahmed Ali', 'ar' => 'نادية أحمد علي'],
            ['en' => 'Salma Sayed Ali', 'ar' => 'سلمى سيد علي'],
            ['en' => 'Samah Mohamed'    , 'ar' => 'سماح محمد'],
            ['en' => 'Kawthar Sayed' , 'ar' => 'كوثر سيد'],
            ['en' => 'Nada Mahmoud' , 'ar' => 'ندى محمود'],
            ['en' => 'Menna Sameh' , 'ar' => 'منة سامح'],
            ['en' => 'Asmaa AbdElrahman' , 'ar' => 'أسماء عبد الرحمن'],
            ['en' => 'Eman Younis' , 'ar' => 'إيمان يونس'],
            ['en' => 'Rahma Ragab' , 'ar' => 'رحمة رجب'],
            ['en' => 'Sara Ragab' , 'ar' => 'سارة رجب'],    
        ];

        $this->parent_emails = [
            'nadia@gmail.com',
            'salma@gmail.com',
            'samah@gmail.com',
            'kawthar@gmail.com',
            'nada@gmail.com',
            'menna@gmail.com',
            'asmaa@gmail.com',
            'eman@gmail.com',
            'rahma@gmail.com',
            'sara@gmail.com'
        ];

        $this->student_names = [
            ['en' => 'Nada Ahmed Mohame' , 'ar' => 'ندى احمد محمد'],
            ['en' => 'Younus Sayed Mohamed' , 'ar' => 'يونس سيد محمد'],
            ['en' => 'Rana Atef Ahmed' , 'ar' => 'رنا عاطف أحمد'],
            ['en' => 'Youssef Nabil Mohamed' , 'ar' => 'يوسف نبيل محمد'],
            ['en' => 'Aya Nader Sayed' , 'ar' => 'أية نادر سيد'],
            ['en' => 'Hamza Sameh Ahmed' , 'ar' => 'حمزة سامح أحمد'],
            ['en' => 'Malak Mohamed Helmy' , 'ar' => 'ملك محمد حلمي'],
            ['en' => 'Nader Hussien Hassan' , 'ar' => 'نادر حسين حسن'],
            ['en' => 'Farha Hassan Sayed' , 'ar' => 'فرح حسن سيد'],
            ['en' => 'Malek AbdElrahman Mohamed' , 'ar' => 'مالك عبد الرحمن محمد'],
        ];

        $this->student_emails = [
            'nada22@gmail.com',
            'younus22@gmail.com',
            'rana22@gmail.com',
            'youssef22@gmail.com',
            'aya22@gmail.com',
            'hamza22@gmail.com',
            'malak22@gmail.com',
            'nader22@gmail.com',
            'farah22@gmail.com',
            'malek22@gmail.com'
        ];

        $this->images = [
            'seeder/s3.jpg',
            'seeder/s1.jpg',
            'seeder/s7.jpg',
            'seeder/s2.jpg',
            'seeder/s8.jpg',
            'seeder/s5.jpg',
            'seeder/s9.jpeg',
            'seeder/s6.jpg',
            'seeder/s10.jpg',
            'seeder/s4.jpg',
            
        ];
        
    }
    
    public function run()
    {


        for($i = 0; $i< count($this->student_names); $i++)
        {

            //create  parent
            $parent = StudentParent::create([
                'father_name'            => $this->father_names[$i],
                'father_national_id'     => rand(10000000000000 , 99999999999999),
                'father_passport_number' => '',
                'father_phone_number'    => '011' . rand(10000000 , 99999999),
                'father_job'             => 'doctor',
                'father_blood_type_id'   => BloodType::inRandomOrder()->first()->id,
                'father_nationality_id'  => Nationality::where('name->en' , 'Egyptian')->first()->id,
                'father_relision_id'     => Relision::first()->id,
                'father_address'         => 'El-Haram',
    
                'mother_name'            => $this->mother_names[$i],
                'mother_national_id'     => rand(10000000000000 , 99999999999999),
                'mother_passport_number' => '',
                'mother_phone_number'    => '011' . rand(10000000 , 99999999),
                'mother_job'             => 'teacher',
                'mother_blood_type_id'   => BloodType::inRandomOrder()->first()->id,
                'mother_nationality_id'  => Nationality::where('name->en' , 'Egyptian')->first()->id,
                'mother_relision_id'     => Relision::first()->id,
                'mother_address'         => 'El-Haram',  
    
                'email'                  => $this->parent_emails[$i],
                'password'               => '123456',
            ]);

            $education_class_room = EducationalClassRoom::inRandomOrder()->first();
            $start = strtotime("01 September 2000");
            $end = strtotime("22 July 2001");
            $timestamp = mt_rand($start, $end);
            $birth_date = date("Y-m-d", $timestamp);


            $start_joining = strtotime("01 September 2021");
            $end_joining = strtotime("22 July 2022");
            $timestamp_joining = mt_rand($start_joining, $end_joining);
            $joining_date = date("Y-m-d", $timestamp_joining);

            $student = Student::create([
                
                'name'           => $this->student_names[$i],
                'email'          => $this->student_emails[$i],
                'password'       => '123456',
                'class_room_id'  => $education_class_room->class_room_id,
                'educational_class_room_id' => $education_class_room->id,


                'code'           => '22' . rand(1111 , 4444),
                'national_id'    => rand(10000000000000 , 99999999999999),
                'gender'         => $i % 2 == 0 ? 'male' : 'female', 
                'birth_date'     => $birth_date,
                'birth_place'    => ['en' => 'El-Haram' , 'ar' => 'الهرم'],
                'phone_number1'  => '011' . rand(10000000 , 99999999),
                'phone_number2'  => '011' . rand(10000000 , 99999999),
                'blood_type_id'  => BloodType::inRandomOrder()->first()->id,
                'nationality_id' => Nationality::where('name->en' , 'Egyptian')->first()->id,
                'relision_id'    => Relision::first()->id,
                'address'        => 'El-Haram',

                'transferred_from_school' => '',
                'joining_date'     => $joining_date,
                'student_parent_id'=> $parent->id,
                'notes' => 'notes',
                
            ]);

            $student->attachments()->create([
                'path' => $this->images[$i],
                'type' => "profile_picture",
            ]);
        }
    }
}
