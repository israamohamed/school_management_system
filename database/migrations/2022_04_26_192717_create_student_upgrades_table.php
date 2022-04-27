<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentUpgradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_upgrades', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->unsignedBigInteger('previous_class_room_id');
            $table->unsignedBigInteger('previous_educational_class_room_id')->nullalbe();
            $table->string('previous_academic_year');

            $table->unsignedBigInteger('next_class_room_id');
            $table->unsignedBigInteger('next_educational_class_room_id')->nullalbe();
            $table->string('next_academic_year');

            $table->foreign('student_id')->references('id')
                    ->on('students')->onDelete('cascade');


            $table->foreign('previous_class_room_id')->references('id')
                    ->on('class_rooms')->onDelete('cascade');

            $table->foreign('previous_educational_class_room_id')->references('id')
                    ->on('educational_class_rooms')->onDelete('cascade');

            $table->foreign('next_class_room_id')->references('id')
                    ->on('class_rooms')->onDelete('cascade');

            $table->foreign('next_educational_class_room_id')->references('id')
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
        Schema::dropIfExists('student_upgrades');
    }
}
