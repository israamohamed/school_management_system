<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('academic_year');
            $table->unsignedBigInteger('class_room_id');
            $table->unsignedBigInteger('educational_class_room_id')->nullable();
            
            $table->date('attendance_date');
            $table->boolean('attendance_status')->nullable();

            $table->unsignedBigInteger('absence_reason_id')->nullable();


            $table->foreign('student_id')->references('id')
                    ->on('students')->onDelete('cascade');

            $table->foreign('class_room_id')->references('id')
                    ->on('class_rooms')->onDelete('cascade');

            $table->foreign('educational_class_room_id')->references('id')
                    ->on('educational_class_rooms')->onDelete('set null');

            $table->foreign('absence_reason_id')->references('id')
                    ->on('absence_reasons')->onDelete('set null');

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
        Schema::dropIfExists('student_attendances');
    }
}
