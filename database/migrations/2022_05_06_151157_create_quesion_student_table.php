<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuesionStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_student', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('quiz_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('choice_id');
            $table->boolean('correct');

            $table->decimal('score' , 22 , 2 )->nullable();

            $table->foreign('quiz_id')->references('id')
                    ->on('quizzes')->onDelete('cascade');

            $table->foreign('student_id')->references('id')
                    ->on('students')->onDelete('cascade');

            $table->foreign('question_id')->references('id')
                    ->on('questions')->onDelete('cascade');

            $table->foreign('choice_id')->references('id')
                    ->on('choices')->onDelete('cascade');

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
        Schema::dropIfExists('question_student');
    }
}
