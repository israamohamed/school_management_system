<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Nationality;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nationalities')->delete();
     
        $nationalities = [
            ['en'=> 'Afghan','ar'=> 'أفغانستاني'],
            ['en'=> 'Algerian','ar'=> 'جزائري'],
            ['en'=> 'Argentinian','ar'=> 'أرجنتيني'],
            ['en'=> 'Bahraini','ar'=> 'بحريني'],
            ['en'=> 'Belarusian','ar'=> 'روسي'],
            ['en'=> 'Brazilian','ar'=> 'برازيلي'],
            ['en'=> 'Central African','ar'=> 'أفريقي'],
            ['en'=> 'Chinese','ar'=> 'صيني'],
            ['en'=> 'French','ar'=> 'فرنسي'],
            ['en'=> 'German','ar'=> 'ألماني'],
            ['en'=> 'Iranian','ar'=> 'إيراني'],
            ['en'=> 'Italian','ar'=> 'إيطالي'],
            ['en'=> 'Jordanian','ar'=> 'أردني'],
            ['en'=> 'Kuwaiti','ar'=> 'كويتي'],
            ['en'=> 'Palestinian','ar'=> 'فلسطيني'],
            ['en'=> 'Egyptian','ar'=> 'مصري']
        ];
            
        foreach ($nationalities as $n) {
            Nationality::create(['name' => $n]);
        }
    }
}
