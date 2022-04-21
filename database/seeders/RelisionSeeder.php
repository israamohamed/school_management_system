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
            'name' => ['en' => 'Muslim' , 'ar' => 'مسلم'],
            'name' => ['en' => 'Christian' , 'ar' => 'مسيحي'],
            'name' => ['en' => 'Other' , 'ar' => 'غير ذلك'],
        ];
    }
}
