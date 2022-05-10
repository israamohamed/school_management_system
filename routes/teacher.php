<?php

use Illuminate\Support\Facades\Route;


Route::get('teacher/'      , 'AuthController@login_view')->name('teacher.login_view');
Route::post('teacher/login' , 'AuthController@login')->name('teacher.login');
Route::post('teacher/logout' , 'AuthController@logout')->name('teacher.logout');



Route::group(['prefix' => LaravelLocalization::setLocale() , 'middleware' => ['auth:teacher' , 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {

    Route::name('teacher.')->prefix('teacher')->group(function(){

        Route::get('home' , 'HomeController@index')->name('home');
        //Quizzes
        Route::resource('quiz' , 'QuizController');
        //Questions
        Route::resource('question' , 'QuestionController');
        //Student Attendance
        Route::resource('student_attendance' , 'StudentAttendanceController');
        //Online Classes
        Route::resource('online_class' , 'OnlineClassController');
        //Subjects
        Route::get('subject/show/{id}' , 'SubjectController@show')->name('subject.show');
        Route::post('subject/store_attachments/{subject_id}' , 'SubjectController@store_attachments')->name('subject.store_attachments');
        Route::put('subject/update_attachment/{id}' , 'SubjectController@update_attachment')->name('subject.update_attachment');
        Route::delete('subject/destroy_attachment/{id}' , 'SubjectController@destroy_attachment')->name('subject.destroy_attachment');
        Route::get('subject/download_attachment/{id}' , 'SubjectController@download_attachment')->name('subject.download_attachment');

    }); 
    
});

