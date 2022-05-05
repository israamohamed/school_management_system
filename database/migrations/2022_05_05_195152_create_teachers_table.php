<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone_number1')->nullable();
            $table->string('phone_number2')->nullable();
            $table->enum('gender' , ['male' , 'female']);
            $table->date('hiring_date')->nullable();
            $table->date('birth_date')->nullable();
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('teachers');
    }
}
