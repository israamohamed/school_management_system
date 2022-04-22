<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale() , 'middleware' => ['auth' , 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {

    Route::name('dashboard.')->prefix('dashboard')->namespace('Dashboard')->group(function(){

        Route::get('/home' , 'HomeController@index')->name('home');
        //Educatinal stages
        Route::resource('educational_stage' , 'EducationalStageController');
        Route::get('get_class_rooms' , 'EducationalStageController@get_class_rooms')->name('get_class_rooms');
        //Class Rooms
        Route::resource('class_room' , 'ClassRoomController');
        Route::post('class_room/delete_selected', 'ClassRoomController@delete_selected')->name('class_room.delete_selected');
        //Educational Class Rooms
        Route::resource('educational_class_room' , 'EducationalClassRoomController');

        //Parents
        Route::resource('student_parent' , 'StudentParentController');
    
    
    });
    
});
