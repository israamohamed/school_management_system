<?php 

use App\Models\SchoolData;
use App\Models\SystemSetting;

function school_data()
{
    $school_data = SchoolData::first();
    return $school_data;
}

function system_settings()
{
    $system_settings = SystemSetting::first();
    return $system_settings;
}