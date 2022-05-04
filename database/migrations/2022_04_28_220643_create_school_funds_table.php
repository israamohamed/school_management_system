<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('financial_bond_id')->nullable();
            $table->date('date');

            $table->decimal('debit', 22, 2)->default(0)->nullable();
            $table->decimal('credit', 22, 2)->default(0)->nullable();

            $table->foreign('financial_bond_id')->references('id')
                    ->on('financial_bonds')->onDelete('cascade');

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
        Schema::dropIfExists('school_funds');
    }
}
