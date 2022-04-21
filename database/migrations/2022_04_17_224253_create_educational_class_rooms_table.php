<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_class_rooms', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->unsignedBigInteger('class_room_id')->nullable();
            $table->integer('number_of_students')->nullable();
            $table->boolean('active')->default(1);
            
            $table->foreign('class_room_id')->references('id')
                    ->on('class_rooms')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
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
        Schema::dropIfExists('educational_class_rooms');
    }
}
