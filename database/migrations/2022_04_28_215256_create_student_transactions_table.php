<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_transactions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->string('type');
            $table->unsignedBigInteger('student_invoice_id')->nullable();
            $table->unsignedBigInteger('financial_bond_id')->nullable();

            $table->decimal('debit', 22, 2)->default(0)->nullable();
            $table->decimal('credit', 22, 2)->default(0)->nullable();

            $table->date('transaction_date');
            $table->text('notes')->nullable();
            
            
            $table->foreign('student_id')->references('id')
                    ->on('students')->onDelete('cascade');

            $table->foreign('student_invoice_id')->references('id')
                    ->on('student_invoices')->onDelete('cascade');

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
        Schema::dropIfExists('student_transactions');
    }
}
