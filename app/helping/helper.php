<?php 

use App\Models\SchoolData;

function school_data()
{
    $school_data = SchoolData::first();
    return $school_data;
}