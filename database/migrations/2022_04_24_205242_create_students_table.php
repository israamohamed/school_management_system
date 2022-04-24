<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('class_room_id')->nullable();
            $table->unsignedBigInteger('educational_class_room_id')->nullable();

            $table->string('code')->nullable()->unique();
            $table->string('national_id')->nullable();
            $table->enum('gender' , ['male' , 'female']);
            $table->date('birth_date');
            $table->text('birth_place')->nullable();
            $table->string('phone_number1')->nullable();
            $table->string('phone_number2')->nullable();
            $table->unsignedBigInteger('blood_type_id')->nullable();
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->unsignedBigInteger('relision_id')->nullable();
            $table->text('address')->nullable();
            $table->text('transferred_from_school')->nullable();
            $table->date('joining_date')->nullable();
            $table->unsignedBigInteger('student_parent_id')->nullable();
            $table->text('notes');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('active')->default(1);


            $table->foreign('blood_type_id')->references('id')
                    ->on('blood_types')->onDelete('set null');

            $table->foreign('nationality_id')->references('id')
                    ->on('nationalities')->onDelete('set null');

            $table->foreign('relision_id')->references('id')
                    ->on('relisions')->onDelete('set null');

            $table->foreign('student_parent_id')->references('id')
                    ->on('student_parents')->onDelete('set null');

            $table->foreign('user_id')->references('id')
                    ->on('users')->onDelete('set null');

            $table->foreign('class_room_id')->references('id')
                    ->on('class_rooms')->onDelete('set null');

            $table->foreign('educational_class_room_id')->references('id')
                    ->on('educational_class_rooms')->onDelete('set null');



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
        Schema::dropIfExists('students');
    }
}
