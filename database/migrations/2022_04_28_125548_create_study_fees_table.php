<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_fees', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('study_fee_item_id');
            $table->decimal('amount', 22, 4);


            $table->unsignedBigInteger('educational_stage_id')->nullable();
            $table->unsignedBigInteger('class_room_id')->nullable();
            $table->string('academic_year');


            $table->foreign('educational_stage_id')->references('id')
                    ->on('educational_stages')->onDelete('cascade');
                    
            $table->foreign('class_room_id')->references('id')
                    ->on('class_rooms')->onDelete('cascade');


            $table->foreign('study_fee_item_id')->references('id')
                    ->on('study_fee_items')->onDelete('cascade');

            



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
        Schema::dropIfExists('study_fees');
    }
}
