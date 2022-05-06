<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id(); 
            $table->text('name');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('educational_class_room_id')->nullable();
            $table->unsignedBigInteger('subject_id');
            $table->integer('time_in_minutes')->nullable();
            $table->boolean('active')->default(1);
            $table->enum('status' , ['pending' , 'started' , 'finished'])->default('pending');


            $table->foreign('teacher_id')->references('id')
                    ->on('teachers')->onDelete('cascade');

            $table->foreign('subject_id')->references('id')
                    ->on('subjects')->onDelete('cascade');

            $table->foreign('educational_class_room_id')->references('id')
                    ->on('educational_class_rooms')->onDelete('cascade');

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
        Schema::dropIfExists('quizzes');
    }
}
