<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');

            $table->text('father_name')->nullable();
            $table->string('father_national_id')->nullable();
            $table->string('father_passport_number')->nullable();
            $table->string('father_phone_number')->nullable();
            $table->string('father_job')->nullable();
            $table->unsignedBigInteger('father_blood_type_id')->nullable();
            $table->unsignedBigInteger('father_nationality_id')->nullable();
            $table->unsignedBigInteger('father_relision_id')->nullable();
            $table->text('father_address')->nullable();

            $table->text('mother_name')->nullable();
            $table->string('mother_national_id')->nullable();
            $table->string('mother_passport_number')->nullable();
            $table->string('mother_phone_number')->nullable();
            $table->string('mother_job')->nullable();
            $table->unsignedBigInteger('mother_blood_type_id')->nullable();
            $table->unsignedBigInteger('mother_nationality_id')->nullable();
            $table->unsignedBigInteger('mother_relision_id')->nullable();
            $table->text('mother_address')->nullable();


            $table->foreign('father_blood_type_id')->references('id')
                    ->on('blood_types')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('father_nationality_id')->references('id')
                    ->on('nationalities')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('father_relision_id')->references('id')
                    ->on('relisions')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('mother_blood_type_id')->references('id')
                    ->on('blood_types')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('mother_nationality_id')->references('id')
                    ->on('nationalities')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('mother_relision_id')->references('id')
                    ->on('relisions')->onDelete('cascade')->onUpdate('cascade');

          

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
        Schema::dropIfExists('student_parents');
    }
}
