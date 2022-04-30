<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialBondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_bonds', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->date('date');
            $table->string('type');

            $table->decimal('amount', 22, 4);
            $table->text('notes')->nullable();

            $table->foreign('student_id')->references('id')
                    ->on('students')->onDelete('cascade');

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
        Schema::dropIfExists('financial_bonds');
    }
}