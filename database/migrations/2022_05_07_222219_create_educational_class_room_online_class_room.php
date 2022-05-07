<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalClassRoomOnlineClassRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_class_room_online_class', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('educational_class_room_id');
            $table->unsignedBigInteger('online_class_id');

            $table->foreign('educational_class_room_id' , 'ed_cl_ro_on_cl_fo')->references('id')
                    ->on('educational_class_rooms')->onDelete('cascade');

            $table->foreign('online_class_id' , 'on_cl_ed_cl_ro_fo')->references('id')
                    ->on('online_classes')->onDelete('cascade');

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
        Schema::dropIfExists('educational_class_room_online_class_room');
    }
}
