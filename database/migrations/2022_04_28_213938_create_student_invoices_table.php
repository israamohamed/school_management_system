<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_invoices', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('study_fee_id');
            $table->date('invoice_date');

            $table->decimal('final_total', 22, 2);
            $table->decimal('total', 22, 2);
            $table->decimal('discount', 22, 2)->nullable();
            $table->enum('discount_type' , ['fixed' , 'percentage'])->nullable();

            $table->text('notes')->nullable();
            $table->boolean('status')->default(0);



            $table->foreign('student_id')->references('id')
                    ->on('students')->onDelete('cascade');

            $table->foreign('study_fee_id')->references('id')
                    ->on('study_fees')->onDelete('cascade');

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
        Schema::dropIfExists('student_invoices');
    }
}
