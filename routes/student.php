<?php

use Illuminate\Support\Facades\Route;


Route::get('student/'      , 'AuthController@login_view')->name('student.login_view');
Route::post('student/login' , 'AuthController@login')->name('student.login');
Route::post('student/logout' , 'AuthController@logout')->name('student.logout');



Route::group(['prefix' => LaravelLocalization::setLocale() , 'middleware' => ['auth:student' , 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {

    Route::name('student.')->prefix('student')->group(function(){

        Route::get('home' , 'HomeController@index')->name('home');
        // //Quizzes
        // Route::resource('quiz' , 'QuizController');
        // //Questions
        // Route::resource('question' , 'QuestionController');
        // //Student Attendance
        // Route::resource('student_attendance' , 'StudentAttendanceController');
        // //Online Classes
        // Route::resource('online_class' , 'OnlineClassController');
    }); 
    
});

