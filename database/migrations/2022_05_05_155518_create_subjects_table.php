<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->unsignedBigInteger('class_room_id');
            $table->integer('upper_grade')->nullable();
            $table->integer('lower_grade')->nullable();
            $table->boolean('main_subject')->nullable();
            $table->boolean('success_required')->nullable();
            $table->boolean('shared_between_terms')->nullable();
            $table->enum('term' , ['first' , 'second'])->nullable();
            $table->boolean('active')->default(1);

            $table->foreign('class_room_id')->references('id')
                    ->on('class_rooms')->onDelete('cascade');

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
        Schema::dropIfExists('subjects');
    }
}
