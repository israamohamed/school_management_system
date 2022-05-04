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
        Route::get('get_educational_class_rooms' , 'ClassRoomController@get_educational_class_rooms')->name('get_educational_class_rooms');
        //Educational Class Rooms
        Route::resource('educational_class_room' , 'EducationalClassRoomController');

        //Parents
        Route::resource('student_parent' , 'StudentParentController');
        Route::post('student_parent/delete_selected', 'StudentParentController@delete_selected')->name('student_parent.delete_selected');

        //Students
        Route::resource('student' , 'StudentController');
        Route::post('student/delete_selected', 'StudentController@delete_selected')->name('student.delete_selected');
        Route::delete('student/delete_attachment/{id}' , 'StudentController@delete_attachment')->name('student.delete_attachment');
        Route::get('student/download_attachment/{id}' , 'StudentController@download_attachment')->name('student.download_attachment');
        Route::post('student/store_attachments/{id}' , 'StudentController@store_attachments')->name('student.store_attachments');

        //student upgrades
        Route::resource('student_upgrade' , 'StudentUpgradeController');
        Route::post('student_upgrade/return_multiple_students' , 'StudentUpgradeController@return_multiple_students')->name('student_upgrade.return_multiple_students');

        //graduated students
        Route::resource('graduated_student' , 'GraduatedStudentController');
        Route::post('graduated_student/return_multiple_students' , 'GraduatedStudentController@return_multiple_students')->name('graduated_student.return_multiple_students');


        //study fee items
        Route::resource('study_fee_item' , 'StudyFeeItemController');
        Route::get('get_study_fees' , 'StudyFeeItemController@get_study_fees')->name('get_study_fees');

        //study fees
        Route::resource('study_fee' , 'StudyFeeController');
        Route::get('get_student_study_fees' , 'StudyFeeController@get_student_study_fees')->name('get_student_study_fees');
        
        //student invoices
        Route::resource('student_invoice' , 'StudentInvoiceController');

        //financial bonds
        Route::resource('financial_bond' , 'FinancialBondController');
    
    
    });
    
});
