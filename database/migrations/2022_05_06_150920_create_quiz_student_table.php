<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_student', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('student_id');
            $table->decimal('score' , 22 , 2 )->nullable();

            $table->foreign('quiz_id')->references('id')
                    ->on('quizzes')->onDelete('cascade');

            $table->foreign('student_id')->references('id')
                    ->on('students')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_student');
    }
}
