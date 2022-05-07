<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_classes', function (Blueprint $table) {
            $table->id();

            $table->text('topic');
            $table->dateTime('start_time')->nullable();
            $table->integer('duration')->nullable();
            $table->text('password')->nullable();

            $table->unsignedBigInteger('teacher_id');

            $table->text('meeting_id')->nullable();
            $table->text('start_url')->nullable();
            $table->text('join_url')->nullable();

            $table->string('status')->nullable();

            $table->foreign('teacher_id')->references('id')
                    ->on('teachers')->onDelete('cascade');

            


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
        Schema::dropIfExists('online_classes');
    }
}
