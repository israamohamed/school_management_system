<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Relision;

class RelisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('relisions')->delete();

        $data = [
            ['en' => 'Muslim' , 'ar' => 'مسلم'],
            ['en' => 'Christian' , 'ar' => 'مسيحي'],
            ['en' => 'Other' , 'ar' => 'غير ذلك'],
        ];

        foreach ($data as $n) {
            Relision::create(['name' => $n]);
        }
    }
}
