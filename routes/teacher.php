<?php

use Illuminate\Support\Facades\Route;


Route::get('teacher/'      , 'AuthController@login_view')->name('teacher.login_view');
Route::post('teacher/login' , 'AuthController@login')->name('teacher.login');



Route::group(['prefix' => LaravelLocalization::setLocale() , 'middleware' => ['auth:teacher' , 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {

    Route::name('teacher.')->prefix('teacher')->group(function(){

        Route::get('home' , 'HomeController@index')->name('home');
        //Quizzes
        Route::resource('quiz' , 'QuizController');
        //Questions
        Route::resource('question' , 'QuestionController');
        //Student Attendance
        Route::resource('student_attendance' , 'StudentAttendanceController');
    }); 
    
});

