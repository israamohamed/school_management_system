<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalClassRoomTeacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_class_room_teacher', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('educational_class_room_id');

            $table->foreign('teacher_id')->references('id')
                    ->on('teachers')->onDelete('cascade');

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
        Schema::dropIfExists('educational_class_room_teacher');
    }
}
