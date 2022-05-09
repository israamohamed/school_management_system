<?php

use Illuminate\Support\Facades\Route;


Route::get('student/'      , 'AuthController@login_view')->name('student.login_view');
Route::post('student/login' , 'AuthController@login')->name('student.login');
Route::post('student/logout' , 'AuthController@logout')->name('student.logout');



Route::group(['prefix' => LaravelLocalization::setLocale() , 'middleware' => ['auth:student' , 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {

    Route::name('student.')->prefix('student')->group(function(){

        Route::get('home' , 'HomeController@index')->name('home');
        //Online Classes
        Route::get('online_class' , 'OnlineClassController@index')->name('online_class.index');

        //Quizzes
        Route::get('quiz' , 'QuizController@index')->name('quiz.index');
        Route::post('start_quiz/{id}' , 'QuizController@start_quiz')->name('quiz.start_quiz');
        Route::get('get_questions/{id}' , 'QuizController@get_questions')->name('quiz.get_questions');
        Route::post('solve_quiz/{id}' , 'QuizController@solve_quiz')->name('quiz.solve_quiz');
     
    }); 
    
});

